<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable; //Queueable => لما يكون عندي عدد المتسخدمين كثار بعمل ترتيب لعرض الأشعارات
    public $order ;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database' ,  'broadcast' ];
        // $notifiable === model user
        $channels = [ 'database'];
        if($notifiable->notification_preference['order_created']['sms'] ?? false) {
            $channels[] = 'vonage';
        }
        if($notifiable->notification_preference['order_created']['broadcast'] ?? false) {
            $channels[] = 'broadcast';
        }
        if($notifiable->notification_preference['order_created']['mail'] ?? false) {
            $channels[] = 'mail';
        }
        return $channels ;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $add = $this->order->billingAddress;

        return (new MailMessage)
                    ->subject('New Order #'. $this->order->number)
                    ->from('Notification@AbdEnhsais.ps' , 'Ajyal-Store')
                    ->greeting("Welcome {$notifiable->name}")
                    ->line("A New Order {$this->order->number} Created By {$add->name} from {$add->country}" )
                    ->action('Notification Action', url('/dashboard'))
                    ->line('Thank you for using our application!');
                    // ->view(''); // Templete Message
    }
    public function toDatabase($notifiable){
        $add = $this->order->billingAddress;

        return [
            'body' => "A New Order:{$add->name} ",
            'icon' => 'fas fa-envelope',
            'url' =>url('/dashboard')
        ];
    }

    public function toBroadcast($notifiable){
        $add = $this->order->billingAddress;

        return new BroadcastMessage([
            'body' => "A New Order:{$add->name} ",
            'icon' => 'fas fa-envelope',
            'url' =>url('/dashboard')
        ]);
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
