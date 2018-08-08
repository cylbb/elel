<?php

namespace App\Http\Controllers\Admin;

use App\Mail\PrizeShipped;
use App\Models\Event;
use App\Models\EventUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class EventController extends Controller
{
    /**
     * 列表
     * @param Request $request
     */
      public function index(Request $request){
            //得到所有数据
          $events=Event::paginate(3);
          $prizeDates = $events->pluck('prize_time')->toArray();
          foreach ($prizeDates as $prizeDate) {
              $event = Event::where('prize_time', $prizeDate)->first();
              //当开奖时间<=当前时间时，状态为已开奖
              if (date('Y-m-d h:i:s', $prizeDate) <= date('Y-m-d h:i:s', time())) {
                  $event->is_prize = 1;
                  $event->save();
              }
          }
          return view('admin.event.index',compact('events'));
      }

    /**
     * 添加
     * @param Request $request
     */
      public function add(Request $request){
          if($request->isMethod('post')){
              $this->validate($request,[
                  'title' => "required|min:4",
                  'content' => "required|min:6",
              ]);
              $data=$request->all();
              $data['num']=0;
              $data['start_time'] = strtotime($data['start_time']);
              $data['end_time'] = strtotime($data['end_time']);
              $data['prize_time'] = strtotime($data['prize_time']);
              //插入数据
              Event::create($data);
              //提示
              $request->session()->flash('success',"添加成功");
              //跳转
              return redirect()->route('events.index');
          }
          return view('admin.event.add');
      }

    /**
     * 编辑
     * @param Request $request
     * @param $id
     */
      public function edit(Request $request,$id){
         $event=Event::find($id);
         if($request->isMethod('post')){
             $this->validate($request,[
                 'title' => "required|min:4",
                 'content' => "required|min:6",
             ]);
             $data=$request->post();
             $data['start_time'] = strtotime($data['start_time']);
             $data['end_time'] = strtotime($data['end_time']);
             $data['prize_time'] = strtotime($data['prize_time']);
             //修改
             $event->update($data);
             //提示
             $request->session()->flash('success',"添加成功");
             //跳转
             return redirect()->route('events.index');
         }
          return view('admin.event.edit',compact('event'));
      }

    /**
     * 删除
     * @param $id
     */
      public function del(Request $request,$id){
           $event=Event::findOrFail($id);
           $event->delete();
           $request->session()->flash('success',"删除成功");
           return redirect()->route('events.index');
      }

    public function start(Request $request, $id)
    {
        /*//通过id找到对象
        $event = Event::find($id);*/
        //得到所有报名的商户
        $userId = EventUser::where('event_id', $id)->pluck('user_id')->toArray();
        //打乱数组
        shuffle($userId);
        //随机取出中奖商户
        $user=array_shift($userId);
        //取出该活动的奖品
        $prize=EventPrize::where('event_id',$id)->first();
        $prize->user_id=$user;
        if ($prize->save()) {
            $user = User::where('shop_id', $prize->user_id)->first();
            //通过审核发送邮件
            Mail::to($user)->send(new PrizeShipped($prize));
            //提示
            $request->session()->flash('success', '抽奖完成');
            //跳转
            return redirect()->route('events.index');
        }
    }
}
