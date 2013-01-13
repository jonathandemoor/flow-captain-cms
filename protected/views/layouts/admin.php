<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />	
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	
	
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />

</head>

<body>
<?php $this->widget('bootstrap.widgets.TbNavbar', array(
    'type'=>'inverse', // null or 'inverse'
    'brand'=> Yii::app()->params['cms_name'],
    'brandUrl'=>'#',
    'collapse'=>true, // requires bootstrap-responsive.css
    'items'=>array(
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'items'=>array(
                array('label'=>'Home', 'url' => Yii::app()->createUrl('admin/home'), 'active' => ($this->id == 'admin' ? true : false)),
                array('label'=>'Content', 'url'=> Yii::app()->createUrl('contentblock/admin'), 'active' => ($this->id == 'contentblock' ? true : false)),
                array('label'=>'News', 'url' => Yii::app()->createUrl('news/admin'), 'active' => ($this->id == 'news' ? true : false)),
                array('label'=>'Projects', 'url'=>'#'),
            ),
        ),
        array(
            'class'=>'bootstrap.widgets.TbMenu',
            'htmlOptions'=>array('class'=>'pull-right'),
            'items'=>array(
                array('label'=>'Link', 'url'=>'#'),
                '---',
                array('label'=>'Dropdown', 'url'=>'#', 'items'=>array(
                    array('label'=>'Action', 'url'=>'#'),
                    array('label'=>'Another action', 'url'=>'#'),
                    array('label'=>'Something else here', 'url'=>'#'),
                    '---',
                    array('label'=>'Separated link', 'url'=>'#'),
                )),
            ),
        ),
    ),
)); ?>

<div class="container body">
	<?php echo $content; ?>
</div>

</body>
</html>
