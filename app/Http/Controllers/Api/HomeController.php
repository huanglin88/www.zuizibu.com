<?php

namespace App\Http\Controllers\Api;

use App\Rules\Mobile;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class HomeController extends Controller
{
    const SMS_API_URL = 'http://sms-api.luosimao.com';
    const SMS_TIMEOUT = 2;

    public function verifyCode(Request $request)
    {
        $this->validate($request, [
            'mobile' => [new Mobile],
        ]);

        $mobile = $request->mobile;
        $vcode = str_pad(rand(1, 999999), 6, 0, STR_PAD_LEFT);

        $key_code = sprintf('verifyCode#%s', $mobile);
        $key_unique = sprintf('verifyCodeUnique#%s', $mobile);

        if (Cache::has($key_unique)) {
            throw new TooManyRequestsHttpException(5, '验证码请求过于频繁');
        }

        $client = new Client(['base_uri' => self::SMS_API_URL]);
        $response = $client->request('POST', '/v1/send.json', [
            'auth' => ['api', env('SMS_API_KEY')],
            'form_params' => [
                'mobile' => $mobile,
                'message' => sprintf('您的验证码是%s，有效期%d分钟，若非本人操作，请勿泄露。【名扬】', $vcode, self::SMS_TIMEOUT),
            ]
        ]);
        $result = json_decode((string)$response->getBody(), true);
        if ($result['error'] !== 0) {
            throw new ServiceUnavailableHttpException(5, $result['msg']);
        }

        Cache::put($key_code, $vcode, self::SMS_TIMEOUT);
        Cache::put($key_unique, '', 1);
    }
}
