<?php

namespace App\Helpers\Notifications;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Models\User;
use App\Models\Order;
use App\Notifications\GeneralNotification;
use Illuminate\Support\Facades\Notification;
use App\Helpers\Notifications\SendFireBaseNotification;

class SendNotification 
{
    use ApiResponseTrait;
    protected array $received_data;
    protected string $type;

    public function __construct($type, $received_data)
    {
        $this->type = $type;
        $this->received_data = $received_data;
    }

    public function __invoke()
    {
//        dd($this->received_data);
        //send database notification
        Notification::send($this->setUsers(), new GeneralNotification($this->setData()));
        //send firebase notification
        app()->call(new SendFireBaseNotification($this->setData()['title'], $this->setData()['body'], $this->setUsers()->pluck('device_token')->toArray(),$this->setUrl()));
    }

    public function setData()
    {
        switch ($this->type) {
            case 'contact_us':
                return [
                    'title' => 'رسالة تواصل معنا جديدة',
                    'body' =>'قام بارسال رسالة تواصل معنا جديدة' .$this->received_data['name'],
                    'type' => $this->type,
                    'username' => $this->received_data['name'],
                    'url' => $this->setUrl(),
                ];
            case 'new_order':
                $user = User::find($this->received_data['user_id']);
                return [
                    'title' =>'طلب جديد',
                    'body' =>'ارسل اشعار بعمل طلب جديد' . ($user->full_name) ?? '',
                    'type' => $this->type,
                    'username' => $user->full_name ?? '',
                    'url' => $this->setUrl(),
                    'user_id' => $user->id,
                ];
            case 'cancel_order':
                $user = User::find($this->received_data['user_id']);
                return [
                    'title' =>'إلغاء طلب ',
                    'body' => ' ارسل اشعار بالغاء الطلب' . $user->full_name ?? '' ,
                    'type' => $this->type,
                    'username' => $user->full_name ?? '',
                    'url' => $this->setUrl(),
                    'user_id' => $user->id,

                ];
                case 'reject_order':
                    $user = User::find($this->received_data['user_id']);
                    return [
                        'title' =>'رفض طلب ',
                        'body' => 'لقد تم رفض طلبك' ,
                        'type' => $this->type,
                        'url' => $this->setUrl(),
                        'user_id' => $user->id,
    
                    ];
            
            case 'accept_order':
                return [
                    'title' => 'تم الموافقة' ,
                    'body' => 'تم الموافقة على طلبك ',
                    'type' => $this->type,
                    'url' => $this->setUrl(),
                ];
            case 'complete_order':
                return [
                    'title' => 'تم الانتهاء من الطلب',
                    'body' => 'تم اكتمال الطلب بنجاح ',
                    'type' => $this->type,
                    'url' => $this->setUrl(),
                ];
        }//end switch
    }

    public function setUsers()
    {
        switch ($this->type) {
            case 'contact_us':
                return User::role('admin')->get();
            case 'new_order':
                return User::role('admin')->get();
            case 'cancel_order':
                return User::role('admin')->get();
                case 'reject_order':
                    return User::where('id', $this->received_data['user_id'])->get();
            case 'accept_order':
                return User::where('id', $this->received_data['user_id'])->get();
            case 'complete_order':
                return User::where('id', $this->received_data['user_id'])->get();

        }//end switch
    }

    public function setUrl()
    {
        switch ($this->type) {
            case 'contact_us':
                return route('admin.contact-us.index');
            case 'new_order':
            case 'cancel_order':
            case 'reject_order':
            case 'complete_order':
                //return route('admin.Orders');
            case 'accept_order':
        }//end switch
    }

}