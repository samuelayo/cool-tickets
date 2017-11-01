<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Eventickets;
use GuzzleHttp\Client;
use App\TicketPurchased;
use App\Events\TicketPurchased as EventTicketPurchased;



class EventsController extends \App\Http\Controllers\Controller
{


    public function list(){
        $all = Events::orderBy('created_at', 'desc')->paginate(20);
        return View('events.list', compact('all'));
    }

    // public function ticket_list(){
    //     $all = Events::where( DB::raw('YEAR(created_at)'), '=', date('Y'))->orderBy('created_at', 'desc')->paginate(100);
    //     return View('events.list', compact('all'));
    // } 

     public function tlist(Events $id){
     
        $all = Eventickets::where('event', $id->id)->get();
       
        $get_all = new \Illuminate\Database\Eloquent\Collection;

        foreach($all as $one){
          
            $tickets = TicketPurchased::where('ticket_id', $one->id)->with('ticket')->get();
            //$tickets['name'] = $one->name;
            $get_all =  $get_all->merge($tickets);
           
        }
         //event(new EventTicketPurchased($get_all[0], $get_all[0]->ticket, $id));
    
        return View('events.tlist', compact('get_all', 'id'));
    }

    public function create(){
        return View('events.create');
    }

    public function createpost(Request $request){
        $newevent = new Events();
        $newevent->title = $request->get('title');
        $newevent->date = $request->get('date');
        $newevent->description = $request->get('description');
        
        $imageName = rand(0, 18000).rand(19000, 39000). '.' . 
        $request->file('image')->guessClientExtension();
        $request->file('image')->move(
            base_path() . '/public/uploads/events/', $imageName
        );
        $newevent->image = '/uploads/events/'.$imageName;
        $newevent->save();
        
        $types = $request->get('ticket_name');
     
        for($i=0; $i < count($types); $i++){
            $eventticket = new Eventickets();
            $eventticket->name = $request->get('ticket_name')[$i];
            $eventticket->price = $request->get('ticket_price')[$i];
            $eventticket->amount = $request->get('amount')[$i];
            $eventticket->event = $newevent->id;
            $imageName = rand(0, 18000).rand(19000, 39000). '.';
            $eventticket->image = '/uploads/events/tickets/'.$imageName;
            $eventticket->save();
        }
        return redirect('/admin/events');
    }

    public function delete_event(Events $id){
        $id->delete();
        return redirect('/admin/events');
    }

    public function allticktes(){
        return Events::with(['tickets'=>function($tick){
            $tick->with('purchased');
        }])->get();
    }
    public function initiate(){
        $headers = ['Authorization: Bearer sk_test_536b6bea23be98d0562e2cdc0641e17ae70c27cf',
        'Content-Type: application/json'
        ];
        $body = [
        'reference'=>rand(0, 10000),
        'bearer'=>'account',
        'amount'=>'5000',
        'email'=>'aogundipe@coolwazobiainfo.com'
        ];
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'https://api.paystack.co/transaction/initialize',
        CURLOPT_USERAGENT => 'Cool fm ticket payment request',
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_HEADER => false,
        CURLOPT_POSTFIELDS => json_encode($body)
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        return $resp;

    }

    public function ticket_purchased(Request $request){      
        $ticket = new TicketPurchased();
        $ticket->ticket_id = $request->get('ticket_id');
        $ticket->qty = $request->get('qty');
        $ticket->total_amt = $request->get('total_amt');
        $ticket->email = $request->get('email');
        $ticket->save();

        $original_ticket = Eventickets::where('id',$request->get('ticket_id'))->first();
        $original_ticket->amount = $original_ticket->amount - $request->get('qty');
        $original_ticket->save();

        $event = Events::where('id', $original_ticket->event)->first();
        event(new EventTicketPurchased($ticket, $original_ticket, $event));
        return Events::with('tickets')->get();
    }
    public function redeem(TicketPurchased $id){
        $id->redeemed = 1;
        $id->save();
        return $this->allticktes();
    }
}
