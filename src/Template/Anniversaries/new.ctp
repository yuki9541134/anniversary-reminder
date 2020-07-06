<?php echo $this->element('header'); ?>
<h1>記念日を追加する</h1>
<?php
    echo $this->Form->create($anniversary, ['url' => '/anniversaries/add']);
    echo $this->Form->label('お相手');
    echo $this->Form->select('precious_user_id', $precious_user_selector);
    echo $this->Form->label('記念日の種類');
    echo $this->Form->select('anniversary_type', $anniversary_type_selector);
    echo $this->Form->label('記念日の日付');
    echo $this->Form->dateTIme('anniversary_date', [
            'default' => (new DateTime())->format('YMD'),
            'monthNames' => false,
            'hour' => ['hidden' => true],
            'minute' => ['hidden' => true],
            'meridian' => false,
    ]);
    echo $this->Form->button(__('追加する'));
    echo $this->Form->end();
?>
