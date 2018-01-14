<?php
/**
 * Created by PhpStorm.
 * User: lvdingtao
 * Date: 9/1/15
 * Time: 9:05 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class UploadController extends Controller{

    public function upload(Request $request)
    {
        $type = $request->input('type');
        //return $type;
        //echo '方式:'.$request->getMethod();
        if($request->isMethod('post')){
            //确认文件是否有上传
            if($request->hasFile('file')){
                //code..
                $file = $request->file('file');
                if(!$file->isValid()){
                    $result = ['status'=>'failed','msg'=>'上传文件无效！'];
                }else{
                    $extension = $file->getClientOriginalExtension();//取得上传文件的后缀名
                    $path = 'uploads/'.$type.'/';
                    $savePath = $path.date('Ymd',time());
                    File::exists($savePath) or File::makeDirectory($savePath,0755,true);

                    $saveFileName = uniqid().'_'.$type.'.'.$extension;//函数基于以微秒计的当前时间，生成一个唯一的 ID。

                    $fullFileName = $savePath.'/'.$saveFileName;
                    //使用Intervention/image 扩展
                    try{
                        if($type=='avatar'){
                            Image::make($file)->resize(80,80)->save($fullFileName);
                        }elseif($type=='product' || $type=='gasStation'){
                            Image::make($file)->save($fullFileName);
                        }else{
                            $x = $request->input('x');
                            $y = $request->input('y');
                            $w = $request->input('w');
                            $h = $request->input('h');
//                        dd($request->input());
                            Image::make($file)->crop($w, $h, $x, $y)->save($fullFileName);
//                        $file->move($savePath,$saveFileName);
                        }
                    }catch (\Exception $e){
                        return ['status'=>'failed','msg'=> $e->getMessage()];
                    }

                    $result = ['status'=>'success','msg'=>'上传成功！','path'=>$fullFileName];
                }

            }else{
                $result = ['status'=>'failed','msg'=>'请选择上传文件！'];
            }
            return $result;
        }else{
            return '请求错误';
        }

    }
} 