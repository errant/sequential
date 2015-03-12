# Sequential
Sequential lets you create sequences of ID numbers, optionally formatted.

## Install

With composer:

    require "errant/sequential": "1.0.*"

## Examples

    $sequencer = new \Sequential\Sequence('tcp://10.0.0.1:6379');
    $sequencer->reset('test_sequence');
    echo $sequencer->getNextID('test_sequence');

You can also format IDs:

    echo $sequencer->getNextIDFormatted('test_sequence', function($sequence) { return pad_left($sequence, 4, '0'); });