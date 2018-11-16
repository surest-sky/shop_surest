<?php

return [
    'alipay' => [
        'app_id'         => '2016092200567920',
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAucOv28kPhl/R5O4kIRNR0UU9X93ze+Lggc67rXlmhf9ihF+7XpyKisw6/wpzElc1I6uyHB2Xn5J7ddtt+ZfJPZZuHuSGSuapY5tmEMPzlHhGH9I2ZeKbGeWdv99r3X36+ycAHByCFzcF7hhMqDUW0tJc9IfRmrGLi14aTNe+siP25bPVyBlCHaYaJX71qsA2de+csyF+pEqyNfH8AUzbuE5c1CHICbxzZ4mHnPOsmUSbjRP4qdZfGkCCf28QqcvxQxB+DsSUI94CBZqSIJUlGcgntvUhnTyHtNeOuHt0kmBdfuT85QUBFoloY0QsyDnDiT5/8ym6Mf6ZwAEpRviaMQIDAQAB',
        'private_key'    => 'MIIEpAIBAAKCAQEAypHXXd7ifK2Rb61oS8p8w9zxqJ8d5HCnhtMsUGa3KyO2DZGNIo6An+PJ3xOYAT88UN1V0DCSx5vVGqXaObNEB+He5qRsZal3wFqCIbpNYGUAARNI9zQuIjFiTZGzYIR2lqmI3TwyydB95urUGXLK6QrYAf8KMNG8MamLmct/xzUxp/JRPNgFkdBicyKzAdhu0nM9ZbkOpUAEywuP9axgT2pBTrijLpfxGfXwvGU6uW3RDWSil89cb3aq2w17+bKyrdqS9kVEjrbr0lnSWWqjAr290aGkWi6bqinhTXHqqtipcYDwET1rPaSiKmp0YlSjrVq8tC6kKtVAxWjLSHJyqwIDAQABAoIBAAl9N3eAP1/TyaJPnzkdrSaHrRJXEdFnrZFVRxglF6N/ssGD9faOclwLEaPPiSlVyv+GvsRX4ihTlnH/Hu/hA+jSndx0C1ffzmpGUx49We6QDKYAP0TFPvv/EDnN/3cf/WYlXvHuJfrqN1uf2Huwsuyjw2akiderm4NAC/gSXlP4hosmijNIMy4msYrNPdwwPO2gHwWPSP4bBSUgvID9rWtWoQ6huUiQLKCMPkNyQrkDNKBUQZZZlj8ApoNe5iOaSyPdwTEK2zAiL1iovYz2BKYpU7gPLrU6AaZkcqXZ+7m6ZAMKyAV2UibFClTy8jDgs8y3nT7BIs82C9c4Jcsv49ECgYEA9dcF84uP9sGR8bxucACAr/qkKAwAokcEFbz1WY72PcMB1GLIo9dVL4zcQ9PVJKC/D3h1HtHq/An0y0iHoVb03Z36VTN75UssY2G5nBRPr0AI+RVNbghCUQxoopfowSDRowGbTfM89SuGIZ3CPeQ7kuDhp0N2uziQQf+nl+yOB7UCgYEA0vEFRQZNsI5g0lG9YRKDLkKf1QB4Ved9NJaE0LDpTP3PoFmcSIgBHTejh+kE+05j53qC83Y+DUsVAm021+zroi6nncHIL3vL88XXOvbsdFRNi2qIrrKX1IGPyvEwTmuqJywev525HRawgWJbPALGyfe3dfjxJnUd4dCYlvqwTN8CgYB6jeHyoo13RtJZv0US4r1EfV+eczVRsLNxnsx1BBbvfSqJVWGOhAd8d+1KhuzHoLb+oF9KqP1K/i+hs5uhq7bQUDP+i3blPM95D7u2+k0rIXIXsi3yf32H5/a1r6MhvBml+GQSvQKTekoYsgumTQQB2cfEWZZ0COOpcyh6TTwUzQKBgQCnxdU4IhxWideOUD783zmA6LKxOk97m8OkuPbn+V2Fw/WIht1bfvjL4T3q0jYJHz8sk+9lbq1J62bJaE4PjTuY4dylB8SNp7v+pmNaXZyRpZ+LfG8764YBGg9hDVYreUx7HYdTRkI+VZaLQcxovZiYeLLtXNOIj+v1d/B1XOwuJwKBgQC8y4e2GJkVMBIDzVJVXaASm6SIrLMycsFRqhBobljDJOqQ/0sL/dBMaxtnT3aF6skq+Oxs4Y0wTXa83bxBDIrU9KdMDCFLYpVvWxQ7IjFJyDVlzY9fLszlmdQooM6HJCXVJkBOiFUzscOtfNZUcU61ExbhXXkce/hQ6gMhDQTURA==',
        'return_url' =>  'http://shop.surest.cn/alipay/return',
        'log'            => [
            'file' => storage_path('logs/alipay.log'),
        ],
    ],

    'wechat' => [
        'app_id'      => '',
        'mch_id'      => '',
        'key'         => '',
        'cert_client' => '',
        'cert_key'    => '',
        'log'         => [
            'file' => storage_path('logs/wechat_pay.log'),
        ],
    ],
];