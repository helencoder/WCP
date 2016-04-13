
function setCookie(name,value) 
{
	var now = new Date();
	var time = now.getTime();
	time += 3600 * 1000;
	now.setTime(time);
    document.cookie = name + "="+ escape (value) + "; path=/; expires="+now.toUTCString();
} 

function refreshHrCaptcha() {
	$('#captchaHrImg').attr('src',"/jcaptcha.jpg" + '?' + new Date().getTime()).fadeIn();
	$("input[name='yzm']").val('');
}

function refreshPerCaptcha() {
	$('#captchaPerImg').attr('src',"/jcaptcha.jpg" + '?' + new Date().getTime()).fadeIn();
	$("input[name='yzm']").val('');
}

function registerInit(){
	
	setCookie("auth", "");
	
	if(defaultTab == 'ent'){
		$('#entboxTab').click();
	}else{
		refreshPerCaptcha();
	}
	
	
	jQuery.validator.addMethod("mobileexist", function(value, element) {
		var ret = false;
		$.ajax({  
	        type:"POST",  
	        url:'validateMobileExist?t='+new Date().getTime(),  
	        async:false,                                             //同步方法
	        data:{'mobile':value},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		return ret;
	}, "手机已经被注册"); 
	
	jQuery.validator.addMethod("emailexist", function(value, element) {
		var ret = false;
		if(value == ''){
			return true;
		}
		$.ajax({  
	        type:"POST",  
	        url:'validateEmailExist?t='+new Date().getTime(),  
	        async:false,                                             //同步方法
	        data:{'email':value},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		return ret;
	}, "邮箱已经被注册"); 
	
	jQuery.validator.addMethod("qqexist", function(value, element) {
		var ret = false;
		
		if(value == ''){
			return true;
		}
		
		$.ajax({  
	        type:"POST",  
	        url:'validateQqExist?t='+new Date().getTime(),  
	        async:false,                                             //同步方法
	        data:{'qq':value},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		return ret;
	}, "QQ已经被注册"); 
	
	jQuery.validator.addMethod("yzmcheck", function(value, element) {
		var ret = false;
		$.ajax({  
	        type:"POST",  
	        url:'validateYzm?t='+new Date().getTime(),  
	        async:false,                                             //同步方法
	        data:{'yzm':value},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		return ret;
	}, "验证码错误"); 
	
	$(".text-input").blur(function(e){
		$(this).val($.trim($(this).val()));
	});
	
	$("#hrRegistBtn").click(function(){

		$.ajax({
			type:'POST',
			url:"registhr",
			data:{
				email:$("#hrEmail").val(),
				passwd:$("#hrPasswd").val(),
		    	yzm:$("#hrYzm").val()
		    	},	    	
			dataType:'json',
			success:function(json){
				if(json){
					if(json.status=="success"){
						alert("success");
					}else{
						alert("error");
					}
				}
			}
		});
		
		
	});
	
	
	$('#agrcheckbox1').click();
	$('#agrcheckbox1').click(function(){
		if($(this).hasClass('checkedBox')){
			$('#entsub').removeClass('btn-disabled').attr('disabled',false);
		}else{
			$('#entsub').addClass('btn-disabled').attr('disabled',true);
		}
	});
	$('#agreement1').click(function(e){
		$('#agrcheckbox1').click();
		e.stopPropagation();
		e.preventDefault();
	});
		
	
	$('#agrcheckbox2').click();
	$('#agrcheckbox2').click(function(){
		if($(this).hasClass('checkedBox')){
			$('#persub').removeClass('btn-disabled').attr('disabled',false);
		}else{
			$('#persub').addClass('btn-disabled').attr('disabled',true);
		}
	});
	$('#agreement2').click(function(e){
		$('#agrcheckbox2').click();
		e.stopPropagation();
		e.preventDefault();
	});
	
	
}


function sendYzmInterval(){
	currentTime = new Date();
	overTime = currentTime.getTime()-starTime.getTime();
	var limitTime=total - Math.floor(overTime/1000);
	if(limitTime > 0){
		$("#sendYzm").attr("disabled",true);
		$("#sendYzm").val("已发送("+limitTime+")");
	}else{
		$("#sendYzm").attr("disabled",false);
		$("#sendYzm").val("点击获取验证码");
		window.clearTimeout(interval);
	}
}


function entinfoInit(){
	
	jQuery.validator.addMethod("mobileyzmreq", function(value, element) {
		if($("#linkMobile").val() == ''){
			return true;
		}
		
		if(value != ''){
			return true;
		}
		
		return false;
	}, "验证码必须输入"); 
	
	jQuery.validator.addMethod("addressreq", function(value, element) {
		if($("#selectArea1").val() == ''){
			return false;
		}
		if($("#selectArea2").val() == ''){
			return false;
		}
		if($("#selectArea3").val() == ''){
			return false;
		}
		return true;
	}, "请输入联系地址"); 
	jQuery.validator.addMethod("addressreq2", function(value, element) {
		if($("#address").val() == ''){
			return false;
		}
		return true;
	}, "请输入具体地址"); 
	
	jQuery.validator.addMethod("mobileyzm", function(value, element) {
		var ret = false;
		
		if($("#linkMobile").val() == ''){
			return true;
		}
		
		$.ajax({  
	        type:"POST",  
	        url:'validateMobileYzm?t='+new Date().getTime(),  
	        async:false,                                             //同步方法
	        data:{'yzm':value},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		return ret;
	}, "验证码错误"); 
	
	
	$("#sendYzm").click(function(){
		total=60;
		starTime = new Date();
		interval = window.setInterval(sendYzmInterval, "1000");
		
		$.ajax({  
	        type:"POST",  
	        url:'sendMobileYzm?t='+new Date().getTime(),  
	        async:true,
	        data:{'mobile':$("#linkMobile").val()},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });

	});

	$(".text-input").blur(function(e){
		$(this).val($.trim($(this).val()));
	});
	
	selectinit('selectArea',city1,city2,['请选择省市','请选择地区','请选择区县']);
}

function sendEmailInterval(){
	currentTime = new Date();
	overTime = currentTime.getTime()-starTime.getTime();
	var limitTime=total - Math.floor(overTime/1000);
	if(limitTime > 0){
		$("#sendEmail").attr("disabled",true);
		$("#sendEmail").val("已发送("+limitTime+")");
	}else{
		$("#sendEmail").attr("disabled",false);
		$("#sendEmail").val("再次发送激活邮件");
		window.clearTimeout(interval);
	}
}


function checkHrAct(){
	$.ajax({  
        type:"POST",  
        url:'../checkhr?t='+new Date().getTime(),  
        async:true,
        data:{},  
        success: function(result){  
        	var obj = result;
        	if (obj.status == "success" && obj.result == "act" ) {  
        		if(homeUrl == '/'){
        			location.href= '/c';
        		}else{
        			location.href= homeUrl;
        		}
        		
        	}
        },
        complete: function (XHR,TS) { XHR = null; }
    });
}

function entemailInit(){
	
	window.setInterval(checkHrAct, "3000");
	
	$("#sendEmail").click(function(){
		total=60;
		starTime = new Date();
		interval = window.setInterval(sendEmailInterval, "1000");
		
		$.ajax({  
	        type:"POST",  
	        url:'../sendHrEmail?t='+new Date().getTime(),  
	        async:true,
	        data:{},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });

	});
}
function perEmailSend(){
	if($('#sendEmail').hasClass("btn-disabled")){
		return;
	}
	var num=60;
	$('#sendEmail').addClass('btn-disabled').attr('disabled',true);
	
	$.ajax({  
        type:"POST",  
        url:'sendEmailYzm?t='+new Date().getTime(),  
        async:true,
        data:{},  
        success: function(msg){  
        	ret = msg;
        },
        complete: function (XHR,TS) { XHR = null; }
    });
	
	
	var c=setInterval(function(){
		num--;
		$('#sendEmail').html(num+'秒以后重新发送');
		if(num<=0){
			$('#sendEmail').removeClass('btn-disabled').attr('disabled',false);
			$('#sendEmail').html('点击发送邮件');
			clearInterval(c);
			return;
		}
	},1000);
}
function permobileInit(){
	
	jQuery.validator.addMethod("mobileyzm", function(value, element) {
		var ret = false;
		
		$.ajax({  
	        type:"POST",  
	        url:'validateMobileYzm?t='+new Date().getTime(),  
	        async:false,                                             //同步方法
	        data:{'yzm':value},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		return ret;
	}, "验证码错误"); 
	
	var validator=$("#perForm").validate({onkeyup: false});
	
	$('#nextBtn').click(function(){
		$('#nextBtn').addClass('btn-disabled').attr('disabled',true);
		if(validator.form()){
			$('#perForm').submit();
		}else{
			$('#nextBtn').removeClass('btn-disabled').attr('disabled',false);
		}
	});
	
	
//	$('#sendEmail').click(function(){
//		var num=60;
//		$(this).addClass('btn-disabled').attr('disabled',true);
//		
//		$.ajax({  
//	        type:"POST",  
//	        url:'sendEmailYzm?t='+new Date().getTime(),  
//	        async:true,
//	        data:{},  
//	        success: function(msg){  
//	        	ret = msg;
//	        },
//	        complete: function (XHR,TS) { XHR = null; }
//	    });
//		
//		
//		var c=setInterval(function(){
//			num--;
//			$('#sendEmail').html(num+'秒以后重新发送');
//			if(num<=0){
//				$('#sendEmail').removeClass('btn-disabled').attr('disabled',false);
//				$('#sendEmail').html('点击发送邮件');
//				clearInterval(c);
//				return;
//			}
//		},1000);
//		
//	});
	
	$('#sendYzm').click(function(){
		var num=60;
		$(this).addClass('btn-disabled').attr('disabled',true);
		
		$.ajax({  
	        type:"POST",  
	        url:'sendMobileYzm?t='+new Date().getTime(),  
	        async:true,
	        data:{},  
	        success: function(msg){  
	        	ret = msg;
	        },
	        complete: function (XHR,TS) { XHR = null; }
	    });
		
		
		var c=setInterval(function(){
			num--;
			$('#sendYzm').val(num+'秒以后重新发送');
			if(num<=0){
				$('#sendYzm').removeClass('btn-disabled').attr('disabled',false);
				$('#sendYzm').val('点击获取验证码');
				clearInterval(c);
				return;
			}
		},1000);
		
	});
	
}


