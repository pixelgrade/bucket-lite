/*
* Update notofier - contains the functionality for the update notifier page.
*/
jQuery(document).ready(function ($) {

	"use strict";

	function UpdateNotifier() {
		this.init();
	}

	UpdateNotifier.prototype.init = function() {
		this.setInstructionsDialog();
		this.setUpdateDialog();
	};

	UpdateNotifier.prototype.setInstructionsDialog = function() {
		$('#manual-instructions-btn').on("click" , function(e) {
			e.preventDefault();
			$('#manual-instructions').dialog({
				width: 500,
				maxHeight: 500,
				modal: true,
				dialogClass: 'wpGrade-dialog'
			});
		});
	};

	UpdateNotifier.prototype.setUpdateDialog = function() {
		$('#update-btn').on("click", function(e) {
			e.preventDefault();
			if (wpGradeUpdateData.envatoDetails){
				$('#confirm-update').dialog({
					modal:true,
					dialogClass: 'wpGrade-dialog',
					buttons: {
						"Update Theme": function() {
							window.location = wpGradeUpdateData.optionsLink;
						},
						Cancel: function() {
							$( this ).dialog( "close" );
						}
					}
				});
			}
			else {
				$('#no-details').dialog({
					modal: true,
					dialogClass: 'wpGrade-dialog'
				});
			}

		});
	};

	var notifier = new UpdateNotifier();
});
