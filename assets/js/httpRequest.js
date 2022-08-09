$(function(){
	$(".otpform").hide();
	
	$("#btn_login").click(function(){
		$(".error").remove();
		var txtVal = document.getElementById("login").value;
		var pattern = /^[1-9][0-9]{9}$/; //mobile pattern
		var result = pattern.test(txtVal);
		if(result == false){
			$("#login").css("border","2px solid #f50d0d").after("<div class='error'>Please Enter 10 Digit Valid Mobile Number</div>");

		}
		
		if(result == true){
		$.ajax({
			type:"post",
			headers: {"x-api-key": "123456"},
			data:$("#loginfrom").serialize(),
			url:URL+"register",
			success:function(res){
				console.log(res);
				if(res.status == 'success'){
					$("#btn_login").after("<div class='success'>"+res.message+"</div>");
					setTimeout(function () {
						
                     	$(".loginform").slideUp();
                    	 
                 	}, 1000);
					$(".otpform").slideDown();

					// window.location.href = "/home";



				}
				if(res.status == 'failure'){
					$("#btn_login").after("<div class='error'>"+res.message+"</div>");
				}
			}
		})


		}
	})



	// Validate OTP

	$("#btn_otp").click(function(){
		$(".error").remove();
		var txtVal = document.getElementById("otp").value;
		var pattern = /^[0-9]{6}$/; //mobile pattern
		var result = pattern.test(txtVal);
		if(result == false){
			$("#otp").css("border","2px solid #f50d0d").after("<div class='error'>Please Enter 6 Digit Valid OTP Number</div>");

		}else{
		
			$.ajax({
				type:"post",
				headers: {"x-api-key": "123456"},
				data:$("#otpfrom").serialize(),
				url:URL+"verifyotp",
				success:function(res){
					if(res.status == 'failure'){
						$("#otp").css("border","2px solid #f50d0d").after("<div class='error'>"+res.message+"</div>");
					}
					if(res.status == 'success'){
						$("#btn_login").after("<div class='success'>"+res.message+"</div>");
						setTimeout(function () {
							window.location.href = "/home";                    	 
	                 	}, 1500);
					}
				}
			})


		}

	})


	// Logout
	$(".logout").click(function(){
		$.ajax({
				type:"get",
				headers: {"x-api-key": "123456"},
				url:URL+"logout",
				success:function(res){
					if(res.status == 'success'){
							window.location.href = "/"; 
					}  
				}
			})
	});


	// Profile Image
	$("#btn_profile").click(function(){
		
		var filecheck = document.getElementById('profilefromimg').files.length;
		
		if(filecheck == 1){
		var property = document.getElementById('profilefromimg').files[0];
        var image_name = property.name;
        var image_extension = image_name.split('.').pop().toLowerCase();
    	}
        if(jQuery.inArray(image_extension,['png','gif','jpg','jpeg','']) == -1){
          alert("Invalid image file Please select Proper iamge");
        }

      	var form_data = new FormData();
        form_data.append("profile_img",property);
		$.ajax({
            type:'POST',
            headers: {"x-api-key": "123456"},
            url: URL+"profile",
            data:form_data,
            cache:false,
            contentType: false,
            processData: false,
            success:function(data){
            	
                if(data.status == 'success'){
                	setTimeout(function () {
                		alert(data.message);
                		window.location.href = "/home";      	 
	                 	}, 5000);
				              	
                }
            },
            error: function(data){
                console.log("error");
                console.log(data);
            }
        });


	})

	// Register User
	$("#btn_register").click(function(){
		$(".error").remove();
		$("#typeuser").css("border","");
		$("#registernumber").css("border","")
		var txtVal = document.getElementById("registernumber").value;
		var mobilepattern = /^[1-9][0-9]{9}$/; //mobile pattern
		var mobileresult = mobilepattern.test(txtVal);


		var usertype = document.getElementById("typeuser").value;
		var userpattern = /^[0-1]{1}$/; //user pattern
		var userresult = userpattern.test(usertype);
		

		if(mobileresult == false){
			
			$("#registernumber").css("border","2px solid #f50d0d").after("<div class='error'>Please Enter 10 Digit Valid Mobile Number</div>");

		}
		if(userresult == false){
			
			$("#typeuser").css("border","2px solid #f50d0d").after("<div class='error'>Please Select User Role</div>");

		}
		if(mobileresult == true && userresult == true){
			$.ajax({
				type:"post",
				headers: {"x-api-key": "123456"},
				data:$("#registerform").serialize(),
				url:URL+"registeradmin",
				success:function(res){
					console.log(res);
					if(res.status == 'failure'){
						$("#btn_register").css("border","2px solid #f50d0d").after("<div class='error'>"+res.message+"</div>");
					}
					if(res.status == 'success'){
						$("#btn_register").after("<div class='success'>"+res.message+"</div>");
						setTimeout(function () {
							window.location.href = "/newregister";                    	 
	                 	}, 1500);
					}



				}
			})
		}




		
	})


})