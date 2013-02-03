<?php

    $this->pageTitle   = 'Update: ' . $role->name;

?>

<div class="page-header">
    <h1><?php echo $this->pageTitle; ?></h1>
</div>

<?php $this->renderPartial(
    '_form',
    array(
        'item' => $item,
    )
) ?>
