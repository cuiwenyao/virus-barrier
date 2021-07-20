<?php
function UploadFile($msg)
{
	$allowedExts = array("gif", "jpeg", "jpg", "png");
	$temp = explode(".", $msg["name"]);
	$extension = end($temp);     // 获取文件后缀名
	if ((($msg["type"] == "image/gif")
	|| ($msg["type"] == "image/jpeg")
	|| ($msg["type"] == "image/jpg")
	|| ($msg["type"] == "image/pjpeg")
	|| ($msg["type"] == "image/x-png")
	|| ($msg["type"] == "image/png"))
	&& ($msg["size"] < 204800)   // 小于 200 kb
	&& in_array($extension, $allowedExts))
	{
	    if ($msg["error"] > 0)
	    {
	        echo "错误：: " . $msg["error"] . "<br>";
	        return false;
	    }
	    else
	    {
	        echo "上传文件名: " . $msg["name"] . "<br>";
	        echo "文件类型: " . $msg["type"] . "<br>";
	        echo "文件大小: " . ($msg["size"] / 1024) . " kB<br>";
	        echo "文件临时存储的位置: " . $msg["tmp_name"] . "<br>";
	        
	        // 判断当前目录下的 upload 目录是否存在该文件
	        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
	        if (file_exists("upload/" . $msg["name"]))
	        {
	            echo $msg["name"] . " 文件已经存在。 ";
	            return false;
	        }
	        else
	        {
	            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
	            $fname = time();
	            move_uploaded_file( $msg["tmp_name"] , __DIR__."/../upload/" . $fname  );
	            echo "文件存储在: " . "upload/" . $fname;
	            return $fname;
	        }
	    }
	}
	else
	{
	    echo "非法的文件格式";
	    return false;
	}
}