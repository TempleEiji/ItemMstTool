<h3>CSV Import</h3>
<?php
    echo $this->Form->create('Post',array('url'=>'import','type'=>'file'));
    echo $this->Form->input('CsvFile',array('label'=>'','type'=>'file'));
    echo $this->Form->end('Upload');
?>