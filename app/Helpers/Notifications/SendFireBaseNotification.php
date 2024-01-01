<?php


namespace App\Helpers\Notifications;


use App\Models\Setting;

class SendFireBaseNotification
{
    protected $title;
    protected $body;
    protected $url;
    protected $tokens;
    private const SERVER_API_KEY = 'AAAA_srXLyU:APA91bHEsT0ctLaUivcWIoXkrmihGfwgz2ZoOpJhHsKtNNRbGoVuCpkeWDT2WwFa9VIqsaVODuSvbdNgVqA1mraFy7b5Hq6bYAQMf7l6thfKHefh_rJXt_ZWXCNMLWozZdXq8T5p1cdH';

    public function __construct($title, $body, $tokens,$url=null)
    {
        $this->title = $title;
        $this->body = $body;
        $this->tokens = $tokens;
        $this->url = ($url)?:route('admin.dashboard');
    }

    public function __invoke()
    {
        try {
            $tokens = $this->tokens;
            if (count($tokens)) {
                $data = [
                    "registration_ids" => $tokens,
                    "notification" => [
                        "title" => $this->title,
                        "body" => $this->body,
                        "url" => $this->url,
                        "icon" => asset(Setting::where('key', 'logo')->first()->value),
                    ]
                ];
                $dataString = json_encode($data);
                $headers = [
                    'Authorization: key=' . self::SERVER_API_KEY,
                    'Content-Type: application/json',
                ];
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $dataString);
                $response = curl_exec($ch);
                return $response;
            }//end if

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }


    }

}