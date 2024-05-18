		<div class="clearfix"></div>		
	
		<section id="footer" class="footer">
			<div class="col-md-3">&nbsp;</div>
			<div class="col-md-6">
				<div>
					<a href="http://www.weboti.com" target="_blank"><img src="<?php echo get_asset('img', 'logo.png') ?>" /></a>
				</div>
			</div>
			<div class="col-md-3">&nbsp;</div>
		</section>
	<!-- .container --> </div>

	<script src="<?php echo get_asset('js', 'jquery-1.11.3.js'); ?>"></script>
	<script src="<?php echo get_asset('js', 'jquery-ui.min.js'); ?>"></script>
	<script src="<?php echo get_asset('js', 'bootstrap.min.js'); ?>"></script>
	<script src="<?php echo get_asset('js', 'bootstrap-datepicker.js'); ?>"></script>
	<script src="<?php echo get_asset('js', 'common.js'); ?>"></script>
	<?php if ( $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'cloudData' || $this->uri->segment(2) == 'addCloudData' ): ?> <script src="<?php echo get_asset('js', 'admin.js'); ?>"></script> <?php endif ?>
	<?php if ( $this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'cloudDataAll' || $this->uri->segment(2) == 'addCloudData' ): ?> <script src="<?php echo get_asset('js', 'admin.js'); ?>"></script> <?php endif ?>

	<script type="text/javascript">
	$(document).ready(function () {
		//Datepicker 1
		$('#birthdate').datepicker({
			format: "dd/mm/yyyy"
		});

		//Datepicker 2
		$('#date_of_issue').datepicker({
			format: "dd/mm/yyyy"
		});

		////////
		// there's the gallery and the trash
	    var $gallery = $( "#gallery" ),
		$trash = $( "#trash" );
	 
	    // let the gallery items be draggable
	    $( "li", $gallery ).draggable({
	      cancel: "a.ui-icon", // clicking an icon won't initiate dragging
	      revert: "invalid", // when not dropped, the item will revert back to its initial position
	      containment: "document",
	      helper: "clone",
	      cursor: "move"
	    });
	 
	    // let the trash be droppable, accepting the gallery items
	    $trash.droppable({
	      accept: "#gallery > li",
	      activeClass: "ui-state-highlight",
	      drop: function( event, ui ) {
	        deleteImage( ui.draggable );

	      }
				
	    });
	 
	    // let the gallery be droppable as well, accepting items from the trash
	    $gallery.droppable({
	      accept: "#trash li",
	      activeClass: "custom-state-active",
	      drop: function( event, ui ) {
	        recycleImage( ui.draggable );

	      }
	    });
	 
	    // image deletion function
	    var draggableCounter = 0;
	    var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
	    function deleteImage( $item ) {
			$item.fadeOut(0,function() {
				var $list = $( "ul", $trash ).length ?
					$( "ul", $trash ) :
					$( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );

				$item.find( "a.ui-icon-trash" ).remove();
				$item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
				  $item
					.animate({ width: "78px", height: "100px" })
				    .find( "img" )
						.animate({ width: "64px", height: "75px" }, function () {
						$item.children().children('p').addClass('hidden');

							var student_id = $item.data('student-id');
							var training_id = $item.data('training-id');
							$.post('add_incoming_student/'+student_id+'/'+training_id,function(output){
								if (output!='') {
									alert(output);
									
								};
							});
						
				      });
				});
			});
				
	    }
	 
	    // image recycle function
	    var trash_icon = "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
	    function recycleImage( $item ) {
	      $item.fadeOut(function() {
	        $item
	          .find( "a.ui-icon-refresh" )
	            .remove()
	          .end()
	          .css({ width: "96px", height: "175px" })
	          .append( trash_icon )
	          .find( "img" )
	            .css({ width: "100%", height: "107px" })
	          .end()
	          .appendTo( $gallery )
	          .fadeIn();
	      });

			$item.children().children('p').removeClass('hidden');

			var student_id = $item.data('student-id');
			var training_id = $item.data('training-id');
			$.post('remove_incoming_student/'+student_id+'/'+training_id,function(output){
				if (output!='') {
					alert(output);
				};
			});
	    }
	 
	    // image preview function, demonstrating the ui.dialog used as a modal window
	    function viewLargerImage( $link ) {
	      var src = $link.attr( "href" ),
	        title = $link.siblings( "img" ).attr( "alt" ),
	        $modal = $( "img[src$='" + src + "']" );
	 
	      if ( $modal.length ) {
	        $modal.dialog( true );
	      } else {
	        var img = $( "<img alt='" + title + "' width='384' height='288' style='display: none; padding: 8px;' />" )
	          .attr( "src", src ).appendTo( "body" );
	        setTimeout(function() {
	          img.dialog({
	            title: title,
	            width: 400,
	            modal: false
	          });
	        }, 1 );
	      }
	    }
	 
	    // resolve the icons behavior with event delegation
	    $( "ul.gallery > li" ).click(function( event ) {
	      var $item = $( this ),
	        $target = $( event.target );
	 
	      if ( $target.is( "a.ui-icon-trash" ) ) {
	        deleteImage( $item );
					$('.tooltip').hide();
	      } else if ( $target.is( "a.ui-icon-zoomin" ) ) {
	        viewLargerImage( $target );
	      } else if ( $target.is( "a.ui-icon-refresh" ) ) {
	        recycleImage( $item );
	      }
	 
	      return false;
	    });
	});
	</script>
	
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	
	  ga('create', 'UA-70688514-1', 'auto');
	  ga('send', 'pageview');
	
	</script>
</body>
</html>