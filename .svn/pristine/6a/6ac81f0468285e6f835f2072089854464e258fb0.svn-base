<?php $__env->startSection("contentheader_title", "Configuration"); ?>
<?php $__env->startSection("contentheader_description", ""); ?>
<?php $__env->startSection("section", "Configuration"); ?>
<?php $__env->startSection("sub_section", ""); ?>
<?php $__env->startSection("htmlheader_title", "Configuration"); ?>

<?php $__env->startSection("headerElems"); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection("main-content"); ?>

<?php if(count($errors) > 0): ?>
	<div class="alert alert-danger">
		<ul>
			<?php foreach($errors->all() as $error): ?>
				<li><?php echo e($error); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
<?php endif; ?>
<form action="<?php echo e(route(config('laraadmin.adminRoute').'.la_configs.store')); ?>" method="POST">
	<!-- general form elements disabled -->
	<div class="box box-warning">
		<div class="box-header with-border">
			<h3 class="box-title">Grafikus beállítások</h3>
		</div>
		<!-- /.box-header -->
		<div class="box-body">
			<?php echo e(csrf_field()); ?>

			<!-- text input -->
			<div class="form-group">
				<label>Oldal neve</label>
				<input type="text" class="form-control" placeholder="Lara" name="sitename" value="<?php echo e($configs->sitename); ?>">
			</div>
			<div class="form-group">
				<label>Oldal első szó</label>
				<input type="text" class="form-control" placeholder="Lara" name="sitename_part1" value="<?php echo e($configs->sitename_part1); ?>">
			</div>
			<div class="form-group">
				<label>Oldal második szó</label>
				<input type="text" class="form-control" placeholder="Admin 1.0" name="sitename_part2" value="<?php echo e($configs->sitename_part2); ?>">
			</div>
			<div class="form-group">
				<label>Oldal rövid neve</label>
				<input type="text" class="form-control" placeholder="LA" maxlength="2" name="sitename_short" value="<?php echo e($configs->sitename_short); ?>">
			</div>
			<div class="form-group">
				<label>Oldal leírása</label>
				<input type="text" class="form-control" placeholder="Description in 140 Characters" maxlength="140" name="site_description" value="<?php echo e($configs->site_description); ?>">
			</div>
			<!-- checkbox -->
			<div class="form-group">
				<div class="checkbox">
					<label>
						<input type="checkbox" name="sidebar_search" <?php if($configs->sidebar_search): ?> checked <?php endif; ?>>
						Kereső mutatása
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_messages" <?php if($configs->show_messages): ?> checked <?php endif; ?>>
						Üzenetek értesítés ikonja
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_notifications" <?php if($configs->show_notifications): ?> checked <?php endif; ?>>
						Értesítések ikonja
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_tasks" <?php if($configs->show_tasks): ?> checked <?php endif; ?>>
						Show Tasks Icon
					</label>
				</div>
				<div class="checkbox">
					<label>
						<input type="checkbox" name="show_rightsidebar" <?php if($configs->show_rightsidebar): ?> checked <?php endif; ?>>
						Show Right SideBar Icon
					</label>
				</div>
			</div>
			<!-- select -->
			<div class="form-group">
				<label>Téma színe</label>
				<select class="form-control" name="skin">
					<?php foreach($skins as $name=>$property): ?>
						<option value="<?php echo e($property); ?>" <?php if($configs->skin == $property): ?> selected <?php endif; ?>><?php echo e($name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			
			<div class="form-group">
				<label>Kinézet</label>
				<select class="form-control" name="layout">
					<?php foreach($layouts as $name=>$property): ?>
						<option value="<?php echo e($property); ?>" <?php if($configs->layout == $property): ?> selected <?php endif; ?>><?php echo e($name); ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Alap email cím</label>
				<input type="text" class="form-control" placeholder="To send emails to others via SMTP" maxlength="100" name="default_email" value="<?php echo e($configs->default_email); ?>">
			</div>
		</div><!-- /.box-body -->
		<div class="box-footer">
			<button type="submit" class="btn btn-primary">Save</button>
		</div><!-- /.box-footer -->
	</div><!-- /.box -->
</form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('la-assets/plugins/datatables/datatables.min.css')); ?>"/>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('la-assets/plugins/datatables/datatables.min.js')); ?>"></script>

<?php $__env->stopPush(); ?>

<?php echo $__env->make("la.layouts.app", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>