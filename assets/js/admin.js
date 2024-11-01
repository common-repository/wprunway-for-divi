jQuery(document).ready(function($) {
	function switchTab(tab) {
		$('.wpfd_admin_tablinks').removeClass('active');
		$('.wpfd_admin_tabcontent').hide();
		tab.addClass('active');
		$(tab.data("target")).show();
	}
	
	switchTab($('.wpfd_admin_defaulttablink'));
	
	$('.wpfd_admin_tablinks').on('click', function(){
		switchTab($(this));
	});
});