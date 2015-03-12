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

    function padFormat($sequence) {
        return str_pad($sequence, 5, '0', STR_PAD_LEFT);
    }
    echo $sequencer->getNextIDFormatted('test_sequence', padFormat);