<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />	
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/admin.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/colors.css" />
</head>
<body>
	<?php 
	if($this->user_main) {
		$this->widget('bootstrap.widgets.TbNavbar', array(
		    'type'		=> 'inverse', 
		    'brand'		=> Yii::app()->params['cms_name'],
		    'brandUrl'	=> array('admin/admin/home'),
		    'collapse'	=> true,
		    'items'=>array(
		        array(
		            'class' => 'bootstrap.widgets.TbMenu',
		            'items' => array(
		                array('label' => 'Content', 'icon' => 'th-list', 'url'=> array('admin/contentBlock/index'), 'active' => ($this->id == 'contentblock' ? true : false)),
		                array('label' => 'News', 'icon' => 'fire', 'url' => array('admin/news/index'), 'active' => ($this->id == 'news' ? true : false)),
		                array('label' => 'Projects', 'icon' => 'briefcase', 'url' => array('admin/project/index'), 'active' => ($this->id == 'project' ? true : false)),
		            ),
		        ),
		        array(
		            'class' => 'bootstrap.widgets.TbMenu',
		            'htmlOptions' => array('class' => 'pull-right'),
		            'items' => array(
		                array('label' => $this->user_main->fullname, 'icon' => 'user', 'items'=>array(
		                    array('label' => 'Profile', 'url' => array('admin/admin/profile')),
		                    array('label' => 'Log Out', 'url' => array('/logout')),
		                ), 'active' => true),
		            ),
		        ),
		        array(
		            'class' => 'bootstrap.widgets.TbMenu',
		            'htmlOptions' => array('class'=>'pull-right'),
		            'items'=>array(
		                array('label' => 'Manage', 'items' =>array(
		                    array('label' => 'Users', 'url' => array('admin/user/index')),
		                    array('label' => 'Roles', 'url' => array('admin/role/index')),
		                    array('label' => 'Pages', 'url' => array('admin/page/index')),
		                ), 'active' => ($this->id == 'user' || $this->id == 'page' || $this->id == 'role' ? true : false)),
		            ),
		        ),
		    ),
		)); 
	} ?>
	
	<div class="container body">
		<?php echo $content; ?>
	</div>
</body>
</html>
