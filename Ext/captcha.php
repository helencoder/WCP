<?php
/**
 * Author: helen
 * CreateTime: 2016/3/30 17:21
 * description:
 */
class captcha{
    /**
    +----------------------------------------------------------
     * ������֤��
    +----------------------------------------------------------
     * @static
     * @access public
    +----------------------------------------------------------
     * @param int $len  ��֤���ַ���
     * @param int $font_size  ��֤�������С
     * @param string $name  session����
     * @param int $width  ͼƬ����
     * @param int $height  ͼƬ�߶�
    +----------------------------------------------------------
     * @return void
    +----------------------------------------------------------
     */
    static function generate($len=4,$font_size=48,$name='captcha',$width='',$height=''){
        if($width=='') $width=($font_size+5)*($len+1);
        if($height=='') $height=($font_size)*2;
        $chars='bcdefhkmnrstuvwxyABCDEFGHKMNPRSTUVWXY345689';
        $str='';
        for($i=0;$i<$len;$i++){
            $str .= substr($chars,mt_rand(0,strlen($chars)-1),1);
        }
        $_SESSION[$name]=$str;//д��session
        for($num=0;$num<10;$num++){
            ob_start();
            $image=imagecreatetruecolor($width,$height);//����ͼƬ
            $bg_color=imagecolorallocate($image,255,255,255);//���ñ�����ɫ
            $border_color=imagecolorallocate($image,100,100,100);//���ñ߿���ɫ
            $text_color=imagecolorallocate($image,0,0,0);//������֤����ɫ
            imagefilledrectangle($image,0,0,$width-1,$height-1,$bg_color);//���ͼƬ����ɫ
            imagerectangle($image,0,0,$width-1,$height-1,$border_color);//���ͼƬ�߿���ɫ
            for($i=0;$i<5;$i++){
                $line_color=imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));//��������ɫ
                imageline($image,rand(0,$width),0,$width,$height,$line_color);//��һ���߶�
            }
            for($i=0;$i<500;$i++){
                $dot_color=imagecolorallocate($image,rand(0,255),rand(0,255),rand(0,255));//���ŵ���ɫ
                imagesetpixel($image,rand()%$width,rand()%$height,$dot_color);//��һ�����ص�
            }
            for($i=0;$i<$len;$i++){
                imagettftext($image,$font_size,rand(-3,3),$font_size/2+($font_size+5)*$i,$height/1.25-rand(2,3),$text_color,'Groupsex.ttf',$str[$i]);//�ù涨������ͼ��д���ı�
            }
            imagegif($image);
            imagedestroy($image);
            $imagedata[] = ob_get_contents();
            ob_clean();
        }
        require('GIFEncoder.class.php');
        $gif = new GIFEncoder($imagedata);
        ob_clean();//��ֹ����'ͼ�����䱾���д��޷���ʾ'������
        header('Content-type:image/gif');
        echo $gif->GetAnimation();
    }
}