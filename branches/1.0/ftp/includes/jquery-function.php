$.fn.passwordStrength = function( options ){
	return this.each(function(){
		var that = this;that.opts = {};
		that.opts = $.extend({}, $.fn.passwordStrength.defaults, options);
		
		that.div = $(that.opts.targetDiv);
		that.defaultClass = that.div.attr('class');
		 v = $(this)
		 
		.keyup(function(){
     	    
			if( typeof el == "undefined" )
				this.el = $(this);
				
			
			
	    
			
			
			
			s=$('#score').val();
			
			var p = that.percents;
			var t = Math.floor( s / p );

			if( 100 <= s )
				t = this.opts.classes.length - 1;
				
				
				
			this.div
				.removeAttr('class')
				.addClass( this.defaultClass )
				.addClass( this.opts.classes[ t ] );
				
		})
		.after('<a href="#"><img src=\"/images/password.png\" height=\"20\" width=\"20\"" title="Générer un mot de passe" border=0 ></a>')
		.next()
		.click(function(){
			$(this).prev().val( randomPassword() ).trigger('keyup');
			
			$("#confirm_password_box").val($("#password_box").val());
			
			$('#showcharacters').each(function(){this.checked=false;});

			return false;
		});
	});
	
	

	

	function randomPassword() {
		var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$_+";
		var size = 10;
		var i = 1;
		var ret = ""
		while ( i <= size ) {
			$max = chars.length-1;
			$num = Math.floor(Math.random()*$max);
			$temp = chars.substr($num, 1);
			ret += $temp;
			i++;
		}
		return ret;
	}

};
	
$.fn.passwordStrength.defaults = {
	classes : Array('is10','is20','is30','is40','is50','is60','is70','is80','is90','is100'),
	targetDiv : '#passwordStrengthDiv',
	cache : {}
}
$(document)
.ready(function(){
	$('input[name="password_box"]').passwordStrength();
	
	
	

});


