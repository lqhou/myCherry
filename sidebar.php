		<div class="sidebar">

			<div class="sidebox widget_mc_search">
			<form role="search" method="get" id="searchform" class="searchform" action="<?php echo $_SERVER['PHP_SELF']; ?>">
				<div class="mc_search">
					<input type="text" name="s" id="s" onblur="if(this.value == '')this.value='Search...';" onclick="if(this.value == 'Search...')this.value='';" value="Search..." />
					<input type="submit" id="searchsubmit" value="" />
				</div>
			</form>
		</div>

		<div id="side_tab" class="widgettab widget-Tabs">
			<ul class="widget-nav">
				<li class="active" >标题1</li>
				<li>标题2</li>
				<li>标题3</li>
				<li>标题4</li>
			</ul>
			<ul class="widget-navcontent">
					<li class="item item-01 active">
					内容1
					</li>
					<li class="item item-02">
					内容2
					<li class="item item-03">
					内容3
					</li>
					<li class="item item-04">
					内容4
					</li>
			</ul>
		</div>

		<?php if(is_dynamic_sidebar()) dynamic_sidebar('mycherry_sidebar');?>
    </div>
</div> <!-- end sitebody -->

<?php wp_sidebar(); ?>
