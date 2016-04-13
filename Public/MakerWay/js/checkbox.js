$(document).ready(function(){
	$(".radio-btn").off('click');
	$(".radio-btn").on('click', function () {
		  var _this = $(this);
		  var _thisName=$(this).find('input[type="radio"]').attr('name');
		  var _si= $('body').find('input[name="'+_thisName+'"]');
		  _si.parent().parent().removeClass('checkedRadio');
		  _this.addClass('checkedRadio');
		    for(var i=0;i<_si.length;i++) {
		    if(_si[i].value==_this.find('input[type="radio"]').val()){
		    	_si[i].checked=true; // 修改选中状态
		    	break; // 停止循环
		    };
		  };
	});
	
	$('.check-box').off('click');
	$('.check-box').on('click', function () {
		var checkbox=$(this).find('input[type="checkbox"]');
		var num=$('body').data('checkboxnum');
		num=num==null||num==''?0:parseInt(num);
		if($(this).hasClass('checkedBox')){
			$(this).removeClass('checkedBox');
			checkbox[0].checked=false;
			num--;
			$('body').data('checkboxnum',num);
		}else{
			$(this).addClass('checkedBox');
			checkbox[0].checked=true;
			num++;
			$('body').data('checkboxnum',num);
		}
	});
	
	
});
var radioclick=function(){
	$(".radio-btn").off('click');
	$(".radio-btn").on('click', function () {
		 var _this = $(this);
		  var _thisName=$(this).find('input[type="radio"]').attr('name');
		  var _si= $('body').find('input[name="'+_thisName+'"]');
		  _si.parent().parent().removeClass('checkedRadio');
		  _this.addClass('checkedRadio');
		    for(var i=0;i<_si.length;i++) {
		    if(_si[i].value==_this.find('input[type="radio"]').val()){
		    	_si[i].checked=true; // 修改选中状态
		    	break; // 停止循环
		    };
		  };
	});
}
var checkclick= function(count){
	$('.check-box').off('click');
	$('.check-box').on('click', function () {
		var checkbox=$(this).find('input[type="checkbox"]');
		var num=$('body').data('checkboxnum');
		num=num==null||num==''?0:parseInt(num);
		if($(this).hasClass('checkedBox')){
			$(this).removeClass('checkedBox');
			checkbox[0].checked=false;
			num--;
			$('body').data('checkboxnum',num);
		}else{
			$(this).addClass('checkedBox');
			checkbox[0].checked=true;
			num++;
			$('body').data('checkboxnum',num);
		}
		if(count){
			count();
		}
	});
	
}
var count=function(event){
	var length=$('.checkedBox').length;
	$("#count_id").html(length);
}
