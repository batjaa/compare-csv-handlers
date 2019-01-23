Test results:

Tests were run using 2 csv files one 77mb and the other 50mb.

```bash
$ php Native.php
Time: 3.8263728618622
Memory get usage: 16.03 kb
Memory get real usage: 28 mb
Memory get peak usage: 45.66 mb
Memory get peak real usage: 46 mb
Record count: 255852
```

```bash
$ php Pleague.php
Time: 4.8916997909546
Memory get usage: 23.71 kb
Memory get real usage: 28 mb
Memory get peak usage: 45.66 mb
Memory get peak real usage: 46 mb
Record count: 255852
```

```bash
$ php Spout.php
Time: 5.7240660190582
Memory get usage: 20.04 kb
Memory get real usage: 28 mb
Memory get peak usage: 45.66 mb
Memory get peak real usage: 46 mb
Record count: 255852
```