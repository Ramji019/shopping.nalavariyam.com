<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ChatController extends Controller
{

    public function users()
    {
        $login_id = Auth::user()->id;
        $sql = "select id,name,photo,phone from users where id <> $login_id and id in (select distinct sender from messages where recvId=$login_id order by time desc)";
        $users = DB::select(DB::raw($sql));
        if($this->ismobile){
            return view('mobile/chat.index',compact('users'));
        }else{
            return view('chat.index',compact('users'));
        }
    }
	
    public function chat($recvId){
        $sender = Auth::user()->id;
        $sql = "select name,photo from users where id = $recvId";
        $result = DB::select(DB::raw($sql));
        $recv_name = $result[0]->name;
        $recv_photo = $result[0]->photo;
        $sql = "select a.*,b.name,b.photo from messages a,users b where a.sender=b.id and sender in ($sender,$recvId) and recvId in ($sender,$recvId) order by time";
        $messages = DB::select(DB::raw($sql));
        if($this->ismobile){
            return view('mobile/chat.chat',compact('messages','recvId','sender','recv_name','recv_photo'));
        }else{
            return view('chat.chat',compact('messages','recvId','sender','recv_name','recv_photo'));
        }
    }

    public function productchat(Request $request){
        $last_message_id = 0;
        $sender = Auth::user()->id;
        $recvId = $request->recvId;
        $message = $request->message;
        $sql = "insert into messages (sender,recvId,body) values ($sender,$recvId,'$message')";
        DB::insert(DB::raw($sql));
        $sql = "select a.*,b.name,b.photo from messages a,users b where a.sender=b.id and sender in ($sender,$recvId) and recvId in ($sender,$recvId) order by time";
        $messages = DB::select(DB::raw($sql));
        $type = "";
        $chat = "";
        foreach($messages as $msg){
            $last_message_id = $msg->id;
            $body = $msg->body;
            $time = $msg->time;
            $name = $msg->name;
            $time = date("h:i A",strtotime(substr($time,11,5)));
            if($msg->sender == $sender){
                $type = " outgoing";
            }else{
                $type = "";
            }
            $chat = $chat."<div class='single-chat-item".$type."'><div class='user-message'><div class='message-content'><div class='single-message'><p>".$body."</p></div></div><div class='message-time-status'><div class='sent-time'>".$time."</div></div></div></div>";
        }
        echo $chat."<br/>";
    }

    public function getchat($recvId){
        $last_message_id = 0;
        $sender = Auth::user()->id;
        $sql = "select a.*,b.name,b.photo from messages a,users b where a.sender=b.id and sender in ($sender,$recvId) and recvId in ($sender,$recvId) order by time";
        $messages = DB::select(DB::raw($sql));
        $type = "";
        $chat = "";
        foreach($messages as $msg){
            $last_message_id = $msg->id;
            $body = $msg->body;
            $time = $msg->time;
            $name = $msg->name;
            $time = date("h:i A",strtotime(substr($time,11,5)));
            if($msg->sender == $sender){
                $type = " outgoing";
            }else{
                $type = "";
            }
            $chat = $chat."<div class='single-chat-item".$type."'><div class='user-message'><div class='message-content'><div class='single-message'><p>".$body."</p></div></div><div class='message-time-status'><div class='sent-time'>".$time."</div></div></div></div>";
        }
        echo $chat."<br/>";
    }
}

