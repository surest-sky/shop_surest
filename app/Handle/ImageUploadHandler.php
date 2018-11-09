<?php
/**
 * Created by PhpStorm.
 * User: surest.cn
 * Date: 2018/11/9
 * Time: 10:20
 */

namespace App\Handle;

use Image;

use App\Exceptions\UploadException;


class ImageUploadHandler
{
    /**
     * @param $file resource 文件资源
     * @param $dir  string 目录-config('main.upload').$dir
     * @param bool $max_width 裁剪所需的最大宽度
     * @param bool $qniu 是否采用七牛云上传
     */
    public function upload($file,$dir,$max_width=false,$qniu=false)
    {
        try{
            if( !$qniu ){
                return $this->save_local($file,$dir,$max_width);
            }

        }catch (\Exception $e){
            throw new UploadException([
                'message' => '图片上传错误：' . $e->getMessage()
            ]);
        }
    }

    /**
     * 七牛云上传
     * @param $file resource
     * @param $dir string 在这里它会和图片进行拼接，作为前缀存在
     * @param $max_width string 裁剪的宽度
     */
    public function save_qniu($file,$dir,$max_width)
    {

    }

    public function save_local($file,$dir,$max_width)
    {
        $ext = '.' . $file->getClientOriginalExtension();
        $folder_name = config('main.upload_path') . date('Y-m/'). $dir;
        $upload_path = public_path() . '/' . $folder_name;
        $new_filename = substr(md5(time()),-10) . $ext;
        $file->move($upload_path,$new_filename);
        $new_filepath = $upload_path . '/' . $new_filename;

        $this->reduceSize($new_filepath,$max_width);

        return  config('app.url') . $folder_name . '/' . $new_filename;;
    }

    /**
     * 图片裁剪
     */
    public function reduceSize($file_path,$max_width)
    {
        // 先实例化，传参是文件的磁盘物理路径
        $image = Image::make($file_path);
        // 进行大小调整的操作
        $image->resize($max_width, null, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });
        $image->save();
    }
}