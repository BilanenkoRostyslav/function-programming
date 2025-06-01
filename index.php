<?php
// 1
//Звичайна рекурсія
function reverseString($str, $index = 0) {
    if ($index === strlen($str)) return;
    reverseString($str, $index + 1);
    echo $str[$index];
}
//Хвостова рекурсія
function reverseStringTail($str, $index = 0, $acc = '') {
    if ($index === strlen($str)) {
        echo $acc;
        return;
    }
    reverseStringTail($str, $index + 1, $str[$index] . $acc);
}

// 2

class ListNode {
    public $val = 0;
    public $next = null;
    public function __construct($val = 0, $next = null) {
        $this->val = $val;
        $this->next = $next;
    }
}

// Звичайна рекурсія
function swapPairs($head) {
    if ($head === null || $head->next === null) return $head;

    $newHead = $head->next;
    $head->next = swapPairs($head->next->next);
    $newHead->next = $head;
    return $newHead;
}

// Хвостова рекурсія
function swapPairsTail($head) {
    return swapPairsTailHelper($head, null);
}

function swapPairsTailHelper($current, $prev) {
    static $newHead = null;

    if ($current === null || $current->next === null) return $newHead ?? $current;

    $nextNode = $current->next;
    $nextNext = $nextNode->next;

    $nextNode->next = $current;
    $current->next = $nextNext;

    if ($prev !== null) {
        $prev->next = $nextNode;
    } else {
        $newHead = $nextNode;
    }

    return swapPairsTailHelper($nextNext, $current);
}

// 3
// Звичайна рекурсія

function fibonacci($n) {
    if ($n === 0) return 0;
    if ($n === 1) return 1;
    return fibonacci($n - 1) + fibonacci($n - 2);
}
// Хвостова рекурсія

function fibonacciTail($n, $a = 0, $b = 1) {
    if ($n === 0) return $a;
    return fibonacciTail($n - 1, $b, $a + $b);
}

// 4
// Звичайна рекурсія

function climbStairs($n) {
    if ($n === 0 || $n === 1) return 1;
    return climbStairs($n - 1) + climbStairs($n - 2);
}
// Хвостова рекурсія

function climbStairsTail($n, $a = 1, $b = 1) {
    if ($n === 0) return $a;
    return climbStairsTail($n - 1, $b, $a + $b);
}

// 5
// Звичайна рекурсія

function myPow($x, $n) {
    if ($n === 0) return 1;
    if ($n < 0) return 1 / myPow($x, -$n);
    if ($n % 2 === 0) {
        $half = myPow($x, $n / 2);
        return $half * $half;
    } else {
        return $x * myPow($x, $n - 1);
    }
}
// Хвостова рекурсія

function myPowTail($x, $n, $acc = 1) {
    if ($n === 0) return $acc;
    if ($n < 0) return myPowTail(1 / $x, -$n, $acc);

    if ($n % 2 === 0) {
        return myPowTail($x * $x, $n / 2, $acc);
    } else {
        return myPowTail($x, $n - 1, $acc * $x);
    }
}



echo "1. reverseString:<br>";
echo "some - ";
reverseString("some");
echo "<br>";
echo "other - ";
reverseStringTail("other");
echo "<br>";
echo "<br>";

echo "2. swapPairs:<br>";
$a = new ListNode(1, new ListNode(2, new ListNode(3, new ListNode(4))));
echo "1 2 3 4 <br>";
$result = swapPairs($a);
while ($result !== null) {
    echo $result->val . " ";
    $result = $result->next;
}
echo "<br>";
echo "<br>";
echo "5 6 7 8 <br>";
$a = new ListNode(5, new ListNode(6, new ListNode(7, new ListNode(8))));
$result = swapPairsTail($a);
while ($result !== null) {
    echo $result->val . " ";
    $result = $result->next;
}
echo "<br>";
echo "<br>";


echo "3. fibonacci:<br>";
echo fibonacci(5) . "<br>";
echo fibonacciTail(8) . "<br><br>";

echo "4. climbStairs:<br>";
echo climbStairs(7) . "<br>";
echo climbStairsTail(7) . "<br><br>";

echo "5. myPow:<br>";
echo myPow(2, 10) . "<br>";
echo myPowTail(2, 5) . "<br>";

