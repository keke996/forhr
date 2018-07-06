<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        if (!$_SESSION['login']) {
            $this->redirect('Index/login');
        }else{
            if($_SESSION['login']['isadmin']==1){
                $userNum = M('user')->count();
                $userNum = $userNum-1;
                $this->assign('userNum',$userNum);
                $this->display('Index/index');
            }
            
        }
    }

    public function findMe(){
        $name = I('post.name');
        if($name){
            $userinfo = M('user')->where(array('isadmin'=>0,'name'=>$name))->select();
            $userinfo = $userinfo[0];
            $this->assign('userinfo',$userinfo);
            if(!$userinfo){
                $this->error('用户不存在');
                exit;
            }

            $id = $userinfo['id'];
            $jifenlist = M('jifen')->where(array('uid'=>$id))->select();
            $this->assign('list',$jifenlist);
        }
        $this->display('Index/findMe'); 
        
    }



    public function login(){
        $this->display('Index/login');
    }

    public function dologin(){
        $name = I('post.username');
        $pwd = I('post.pwd');
        $map = array('name'=>$name,'pwd'=>$pwd);
        $result = M('user')->where($map)->select();
        if($result){
            $_SESSION['login'] = $result[0];
            $this->success('登录成功','Index/index');
        }else{
            $this->error('账号密码错误');          
        }
    }


    public function dologout(){
        $_SESSION['login'] = null;$this->success('退出登录成功','Index/login');
    }

    //判断是否管理员，不是管理员跳转向首页
    private function isadmin(){
        if($_SESSION['login']['isadmin']!=1){
            $this->error('非管理员禁止操作',U('index/index'));
        }
    }


    public function jifenlist(){
        $this->isadmin();
        $userlist = M('user')->where(array('isadmin'=>0))->order('bumen,ruzhi')->select();
        $this->assign('list',$userlist);
        $this->display('Index/jifenlist');
    }

    public function jifenDetail(){
        $this->isadmin();
        if(I('get.id')){
            $userinfo =  M('user')->where(array('isadmin'=>0,'id'=>I('get.id')))->order('bumen,ruzhi')->select();
            $this->assign('userinfo',$userinfo[0]);
            
            $jifenlist = M('jifen')->where(array('uid'=>I('get.id')))->select();
            $this->assign('list',$jifenlist);
            $this->display('Index/jifenDetail');
        }else{
            $this->error('参数错误');
        }
        
    }

    public function revokeJifen(){
        $this->isadmin();
        $jid = I('post.jid');
        if($jid){
            $data = M('jifen')->field('jid,uid,type,num')->where(array('jid'=>$jid))->find();
            if($data){
                if($data['type']==1){
                    $result=M('user')->where(array('id'=>$data['uid']))->setDec('jifen',$data['num']);
                }else{
                    $result=M('user')->where(array('id'=>$data['uid']))->setInc('jifen',$data['num']);
                }

                if($result){
                    $end = M('jifen')->where(array('jid'=>$jid))->delete();
                }
                $msg = '操作成功';
                
                $jifen = M('user')->field('jifen')->where(array('id'=>$data['uid']))->find();
                $res = array('code'=>200,'msg'=>$msg,'jifen'=>$jifen['jifen']);

            }else{
                $msg = '记录不存在';
                $res = array('code'=>100,'msg'=>$msg);

            }


            
        }else{
            $msg = '参数异常';
            $res = array('code'=>300,'msg'=>$msg);
            
        }
        $this->ajaxReturn($res);

    }
    

    public function doEditJifen(){

        $this->isadmin();
        $data = array(
        'uid'=>I('post.uid'),
        'date'=>I('post.date'),
        'type'=>I('post.type'),
        'num'=>I('post.num'),
        'beizhu'=>I('post.beizhu'),
        );
        foreach($data as $k=>$v){
            if($k!='beizhu'){
                if(empty($v)){
                    $this->error('请将信息填写完整');
                    exit;
                }
            }
        }

        if($data['num']<=0){
            $this->error('数值不能为负数');
            exit;
        }
        

        if($data['type']!=1 && $data['type']!=2){
            $this->error('参数错误');
            exit;
        } 
        
        $m = M('user');
        $m->startTrans();

        if($data['type']==1){
            $result1 = $m->where(array('isadmin'=>0,'id'=>$data['uid']))->setInc('jifen',$data['num']);
        }else if($data['type']==2){
            $result1 = $m->where(array('isadmin'=>0,'id'=>$data['uid']))->setDec('jifen',$data['num']);
        }


        $result2 = M('jifen')->data($data)->add();

        if($result1 && $result2){
            $m->commit();
            $this->success('操作成功');
        }else{
            $m->rollback();
            $this->error('操作失败');
            
        }

       
    }



    public function userlist(){
        $this->isadmin();
        $userlist = M('user')->where(array('isadmin'=>0))->order('bumen,ruzhi')->select();
        $this->assign('list',$userlist);
        $this->display('Index/userlist');
    }

    public function userListData(){
        // $this->isadmin();
        $userlist = M('user')->where(array('isadmin'=>0))->order('bumen,ruzhi')->select();
        
        // $this->display('Index/userlist');
        // echo json_encode($userlist);
        $this->ajaxReturn($userlist);
    }

    public function editUser(){
        $this->isadmin();
        if (!I('get.type')) {
            $this->error('参数错误');
        }
        switch (I('get.type')) {
            case '1':
                if(!I('get.id')){
                    $this->error('参数异常');
                    exit;
                }
                //禁止查看管理员信息
                $map = array('id'=>I('get.id'),'isadmin'=>array('NEQ','1'));
                $result = M('user')->where($map)->select();
                if(!$result){
                    $this->error('参数错误');
                    exit;
                }
                $this->assign('user',$result[0]);
                break;
            
            default:
                # code...
                break;
        }
        
        
        $type = I('get.type');
        $this->assign('type',$type);
        $this->display('Index/editUser');
        
    }

    public function doEditUser(){
        $this->isadmin();
        $data = array('name'=>I('post.name'),
        // 'username'=>I('post.username'),
        'pwd'=>I('post.pwd'),
        'bumen'=>I('post.bumen'),
        'beizhu'=>I('post.beizhu'),
        
        );
        foreach($data as $k=>$v){
            if($k!='beizhu'){
                if(empty($v)){
                    $this->error('请将信息填写完整');
                }
            }
        }
        $ruzhi = I('post.ruzhi');
        if ($ruzhi) {
            $data['ruzhi'] = $ruzhi;
        }
        switch (I('post.type')) {
            //编辑用户
            case '1':
                if(!I('post.id')){
                    $this->error('参数异常');
                    exit;
                }
                $map = array('id'=>I('post.id'),'isadmin'=>array('NEQ','1'));
                $result = M('user')->where($map)->data($data)->save();
                if($result){
                    $this->success('信息修改成功');
                }else{
                    $this->error('信息修改失败');                    
                }
                break;
            
            //添加用户
            case '2';
                $result = M('user')->data($data)->add(); 
                if($result){
                    $this->success('添加成功',U('Index/editUser',array('id'=>$result,'type'=>'1')) );
                }else{
                    $this->error('添加失败');
                }
                break;

            default:
                $this->error('参数错误');
                break;
                
        }
    }

    public function deleteUser(){
        $this->isadmin();
        $id = I('get.id');
        if($id==1 || empty($id) ){
            $this->error('异常操作');
            exit;
        }
        $map = array('id'=>$id,'isadmin'=>array('NEQ','1'));
        $result = M('user')->where($map)->delete();
        if($result){
            $this->success('删除成功');
        }else{
            $this->error('删除失败');
        }
    }

    public function deleteUserAjax(){
        $this->isadmin();
        $id = I('post.id');
        $code= '状态码';
        $msg = '提示';
        if($id==1 || empty($id) ){
            $code = 1001;
            $msg = '用户id违规';
        }else{
            $map = array('id'=>$id,'isadmin'=>array('NEQ','1'));
            $result = M('user')->where($map)->delete();
            if($result){
                $code = 200;
                $msg = '删除成功';
            }else{
                $code = 10004;
                $msg = '删除失败，未知错误';
            }
        }
        $res = array('code'=>$code,'msg'=>$msg);
        $this->ajaxReturn($res);
    }


    // excel操作前置
    private function exportExcel($expTitle,$expCellName,$expTableData){
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle);//文件名称
        $fileName = $expTitle.date('_YmdHis');//or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        vendor("PHPExcel.PHPExcel");
            
        $objPHPExcel = new \PHPExcel();
        $cellName = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

        // $objPHPExcel->getActiveSheet(0)->mergeCells('A1:'.$cellName[$cellNum-1].'1');//合并单元格
        // $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        //栏目名称
        for($i=0;$i<$cellNum;$i++){
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i].'1', $expCellName[$i][1]);
            //上一行参数中的1，为标题所在行
        }
        // Miscellaneous glyphs, UTF-8
        //输出数据
        for($i=0;$i<$dataNum;$i++){
            for($j=0;$j<$cellNum;$j++){
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j].($i+2), $expTableData[$i][$expCellName[$j][0]]);
                // 上一行参数中2，为内容开始行
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="'.$xlsTitle.'.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    /**
     *
     * 导出Excel人员积分表
     */
    public function expJifen(){//导出Excel
        $this->isadmin();
        $xlsName  = "KEKE996员工积分表";
        $xlsCell  = array(
        array('id','账号序列'),
        array('bumen','部门'),
        array('name','姓名'),
        array('beizhu','备注'),
        array('jifen','积分'),
        array('pwd','密码'),
        array('ruzhi','入职时间')
        );
        $xlsModel = M('user');
        $map = array('isadmin'=>array('NEQ','1'));
        $xlsData  = $xlsModel->Field('id,bumen,name,beizhu,jifen,pwd,ruzhi')->where($map)->order('bumen,ruzhi')->select();
        ob_end_clean();
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
            
    }

    public function test(){
        $id = M('user')->where(array('name'=>'小333雪'))->field('id')->select();
        xxl($id);
        var_dump($id);
        if($id){
            echo(333);
        }else{
            echo(444);
        }
    }

    /**实现导入excel
     * 导入积分操作
     **/
    public function impJifen(){
        $this->isadmin();
        if (!empty($_FILES)) {
            $upload = new \Think\Upload();// 实例化上传类
            $filepath='./Public/Excel/'; 
            $upload->exts = array('xlsx','xls');// 设置附件上传类型
            $upload->rootPath  =  $filepath; // 设置附件上传根目录
            $upload->saveName  =     'time';
            $upload->autoSub   =     false;
            if (!$info=$upload->upload()) {
                $this->error($upload->getError());
            }
            foreach ($info as $key => $value) {
                unset($info);
                $info[0]=$value;
                $info[0]['savepath']=$filepath;
            }
            vendor("PHPExcel.PHPExcel");
            $file_name=$info[0]['savepath'].$info[0]['savename'];
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $j=0;
            $p=0;

            //统计失败人名单
            $arr = array();

            //获取当前日期
            $date = date("Y-m-d");

            for($i=2;$i<=$highestRow;$i++)
            {
                $name = $objPHPExcel->getActiveSheet()->getCell("A".$i)->getValue();
                $num = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                $beizhu = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                
                if($num>0){
                    $type = 1;
                }else if($num<0){
                    $type = 2;
                }else{
                    continue;
                }

                $id = M('user')->where(array('name'=>$name))->field('id')->select();
                if($id){
                    $id = $id[0]['id'];
                    $m = M('user');
                    $m->startTrans();
                    $result1 = $m->where(array('id'=>$id))->setInc('jifen',$num);
                    $number = abs($num);
                    $result2 =  M('jifen')->data(array('uid'=>$id,'num'=>$number,'beizhu'=>$beizhu,'date'=>$date,'type'=>$type))->add();
                    if($result1 && $result2){
                        $j++;
                        $m->commit();
                    }else{
                        $p++;
                        $arr[]['name'] = $name;
                        $m->rollback();
                    }
                }else{
                    continue;
                }
            }
            unlink($file_name);

            if($p){
                echo '导入成功'.$j.'人';
                echo '导入失败'.$p.'人';
                xxl($arr);
            }else{
                $this->success('导入成功！本次导入员工积分条数：'.$j);
            }

        }else
        {
            $this->error("请选择上传的文件");
        }
    }


    /**
     *
     * 导出Excel人员表
     */
    public function expUser(){//导出Excel
        $this->isadmin();
        $xlsName  = "KEKE996员工表";
        $xlsCell  = array(
        array('id','账号序列'),
        array('bumen','部门'),
        array('name','姓名'),
        array('beizhu','备注'),
        array('jifen','积分'),
        array('pwd','密码'),
        array('ruzhi','入职时间')
        );
        $xlsModel = M('user');
        $map = array('isadmin'=>array('NEQ','1'));
        $xlsData  = $xlsModel->Field('id,bumen,name,beizhu,jifen,pwd,ruzhi')->where($map)->order('bumen,ruzhi')->select();
        ob_end_clean();
        $this->exportExcel($xlsName,$xlsCell,$xlsData);
            
    }

    /**实现导入excel
     * 导入userlist
     **/
    public function impUser(){
        $this->isadmin();
        if (!empty($_FILES)) {
            $upload = new \Think\Upload();// 实例化上传类
            $filepath='./Public/Excel/'; 
            $upload->exts = array('xlsx','xls');// 设置附件上传类型
            $upload->rootPath  =  $filepath; // 设置附件上传根目录
            $upload->saveName  =     'time';
            $upload->autoSub   =     false;
            if (!$info=$upload->upload()) {
                $this->error($upload->getError());
            }
            foreach ($info as $key => $value) {
                unset($info);
                $info[0]=$value;
                $info[0]['savepath']=$filepath;
            }
            vendor("PHPExcel.PHPExcel");
            $file_name=$info[0]['savepath'].$info[0]['savename'];
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            $j=0;
            for($i=2;$i<=$highestRow;$i++)
            {
                $data['bumen']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                $data['name']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                $data['beizhu']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                $data['jifen']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                $data['pwd']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                //$data['ruzhi']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                // 时间参数处理后
                $data['ruzhi']= excelTime($objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue());
               
                if(M('user')->where(array('name'=>$data['name']))->find()){
                    //如果存在相同联系人。判断条件：姓名 两项一致，上面注释的代码是用姓名判断
                }else{
                    M('user')->add($data);
                    $j++;
                }
            }
            unlink($file_name);
            $this->success('导入成功！本次导入联系人数量：'.$j);
        }else
        {
            $this->error("请选择上传的文件");
        }
    }

    

}