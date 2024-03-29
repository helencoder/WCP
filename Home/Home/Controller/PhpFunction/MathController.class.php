<?php
/**
 * Author: helen
 * CreateTime: 2016/4/12 15:11
 * description: Math函数
 */
namespace Home\Controller\PhpFunction;
use Home\Controller\CommonController;
/*
 *   函数	描述	   PHP
    abs()	绝对值。	3
    acos()	反余弦。	3
    acosh()	反双曲余弦。	4
    asin()	反正弦。	3
    asinh()	反双曲正弦。	4
    atan()	反正切。	3
    atan2()	两个参数的反正切。	3
    atanh()	反双曲正切。	4
    base_convert()	在任意进制之间转换数字。	3
    bindec()	把二进制转换为十进制。	3
    ceil()	向上舍入为最接近的整数。	3
    cos()	余弦。	3
    cosh()	双曲余弦。	4
    decbin()	把十进制转换为二进制。	3
    dechex()	把十进制转换为十六进制。	3
    decoct()	把十进制转换为八进制。	3
    deg2rad()	将角度转换为弧度。	3
    exp()	返回 Ex 的值。	3
    expm1()	返回 Ex - 1 的值。	4
    floor()	向下舍入为最接近的整数。	3
    fmod()	返回除法的浮点数余数。	4
    getrandmax()	显示随机数最大的可能值。	3
    hexdec()	把十六进制转换为十进制。	3
    hypot()	计算直角三角形的斜边长度。	4
    is_finite()	判断是否为有限值。	4
    is_infinite()	判断是否为无限值。	4
    is_nan()	判断是否为合法数值。	4
    lcg_value()	返回范围为 (0, 1) 的一个伪随机数。	4
    log()	自然对数。	3
    log10()	以 10 为底的对数。	3
    log1p()	返回 log(1 + number)。	4
    max()	返回最大值。	3
    min()	返回最小值。	3
    mt_getrandmax()	显示随机数的最大可能值。	3
    mt_rand()	使用 Mersenne Twister 算法返回随机整数。	3
    mt_srand()	播种 Mersenne Twister 随机数生成器。	3
    octdec()	把八进制转换为十进制。	3
    pi()	返回圆周率的值。	3
    pow()	返回 x 的 y 次方。	3
    rad2deg()	把弧度数转换为角度数。	3
    rand()	返回随机整数。	3
    round()	对浮点数进行四舍五入。	3
    sin()	正弦。	3
    sinh()	双曲正弦。	4
    sqrt()	平方根。	3
    srand()	播下随机数发生器种子。	3
    tan()	正切。	3
    tanh()	双曲正切。	4

 *
 * PHP Math 常量
    常量名	常量名	常量值	PHP
    M_E	    e	2.7182818284590452354	4
    M_EULER	Euler 常量	0.57721566490153286061	5.2.0
    M_LNPI	log_e(pi)	1.14472988584940017414	5.2.0
    M_LN2	log_e 2	0.69314718055994530942	4
    M_LN10	log_e 10	2.30258509299404568402	4
    M_LOG2E	log_2 e	1.4426950408889634074	4
    M_LOG10E	log_10 e	0.43429448190325182765	4
    M_PI	Pi	3.14159265358979323846	3
    M_PI_2	pi/2	1.57079632679489661923	4
    M_PI_4	pi/4	0.78539816339744830962	4
    M_1_PI	1/pi	0.31830988618379067154	4
    M_2_PI	2/pi	0.63661977236758134308	4
    M_SQRTPI	sqrt(pi)	1.77245385090551602729	5.2.0
    M_2_SQRTPI	2/sqrt(pi)	1.12837916709551257390	4
    M_SQRT1_2	1/sqrt(2)	0.70710678118654752440	4
    M_SQRT2	sqrt(2)	1.41421356237309504880	4
    M_SQRT3	sqrt(3)	1.73205080756887729352	5.2.0
 * */
class MathController extends CommonController{
    public function main(){

    }
}