<?php
  require_once __DIR__."/../conf/main.conf.php";
  require_once __DIR__."/../func/sql.func.php";
  function backupData($saveFileName = 'isolation_')
  {
    error_reporting(0);
    set_time_limit(0);
    $link = mysql_connect(SQL_HOST, SQL_UNAME, SQL_PWORD) or die('数据库连接失败: ' . mysql_error());
    mysql_select_db(SQL_DBNAME) or die('数据库连接失败: ' . mysql_error());
    mysql_query('set names utf8');
    // 声明变量
    $DbName = SQL_DBNAME;
    $isDropInfo   = '';
    $insertSQL   = '';
    $row      = array();
    $tables     = array();
    $tableStructure = array();
    $fileName    = ($saveFileName ? $saveFileName : 'MySQL_data_bakeup_') . date('Y-m-d-H-i-s') . '.sql';
    // 枚举该数据库所有的表
    $res = mysql_query("SHOW TABLES FROM $DbName");
    while ($row = mysql_fetch_row($res)) {
      $tables[] = $row[0];
    }
    mysql_free_result($res);
    $fname = $fileName;
    $fileName = __DIR__."/../backup/" . $fileName;
 //   echo $fileName . "\n";
    file_put_contents($fileName,"SET FOREIGN_KEY_CHECKS = 0;\r\nset charset utf8;\r\n",FILE_APPEND);
    // 枚举所有表的创建语句
    foreach ($tables as $val) 
    {
      $res = mysql_query("show create table $val", $link);
      $row = mysql_fetch_row($res);
      $isDropInfo   = "DROP TABLE IF EXISTS `" . $val . "`;\r\n";
      $tableStructure = $isDropInfo . $row[1] . ";\r\n";
      file_put_contents($fileName, $tableStructure, FILE_APPEND);
      mysql_free_result($res);
    }

    // 枚举所有表的INSERT语句
    foreach ($tables as $val) {
      $res = mysql_query("select * from $val");

      // 没有数据的表不执行insert
      while ($row = mysql_fetch_row($res)) {
       // echo $val.'<br>';
        $sqlStr = "INSERT INTO `".$val."` VALUES (";
        foreach($row as $v){
          $sqlStr .= "'$v',";
        }
        //去掉最后一个逗号
        $sqlStr = substr($sqlStr, 0, strlen($sqlStr) - 1);
        $sqlStr .= ");\r\n";
        file_put_contents($fileName, $sqlStr , FILE_APPEND);
      }
      mysql_free_result($res);
    }
    file_put_contents($fileName,"SET FOREIGN_KEY_CHECKS = 1;\r\n",FILE_APPEND);
    echo '数据备份成功！文件名：'.$fname;
  }


  
  function restoreData($filename)
  {
    $filename = str_replace("\\", "/", $filename);
  //  $filename = str_replace("\\", "\\\\", $filename);
    if(!is_file($filename))
    {
      echo "备份文件错误，无法恢复！";
      return false;
    }

    $mysqli =new MySQLi(SQL_HOST,SQL_UNAME,SQL_PWORD,SQL_DBNAME);
    if($mysqli->connect_error){
        die ("连接失败".$mysqli->connect_error);
    }

    $ocode = "

    #触发器：药物数量修改前后应该大于等于0
    create trigger upd_medicine before update on isolation_duang_medicine for each row
    begin
      if ( new.count < 0 )  then
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error;
      end if; 
    end ;


    #触发器：若living中存在房间的isusing=1，则isolation_duang不可删除、不可修改nowstate
    create trigger del_room before delete on isolation_duang_room for each row
    begin
      if ( select isolation_duang_living.id from isolation_duang_living where isolation_duang_living.isusing = 1 and isolation_duang_living.room_id = old.id  ) then
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = error;
      end if;
    end ;


    #创建索引
    create index patient_index on isolation_duang_patient (`id`);
    create index doctor_index on isolation_duang_doctor (`id`);
    create index nurse_index on isolation_duang_nurse (`id`);
    create index cleaner_index on isolation_duang_cleaner (`id`);
     ";

    $sqls = file_get_contents($filename);
    $osql = str_replace("isolation_duang",SQL_TABPRE,$ocode);
    $sqls = $sqls . $osql;
    $res = $mysqli->multi_query($sqls);
    if(!($res)){
        echo "操作失败".$mysqli->error;
    }else{
        echo "数据恢复完成。大约10秒后数据将正常显示。";
    }
  }

?>