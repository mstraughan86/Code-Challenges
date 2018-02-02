# DataX

Original code challenge requirements are given in [PHP Code Challenge - 2017.docx](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/PHP%20Code%20Challenge%20-%202017.docx).

First, please clone down this repository and then...

## 1: XML and XLST.

Open [customer.xml](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/customer.xml) in a web browser and it should apply the [customer.xslt](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/customer.xsl) automatically. (Chrome does not work out of the box.)

## 2: MySQL SSN.

Storing data.
From the problem requirements, we don't necessarily care about write performance as we are dealing with data that will be created/updated very infrequently. So my solution will be to add an index on the 'ssn' column in the 'person' table to speed up any queries on that column.

Retrieving data.
If we are looking at the last 4 numbers of the ssn, we select by ```RIGHT(ssn, 4)``` and we still get back the full ssn.

Verify by looking inside the MySQL snippets [SSN Script](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/SSN_Script.txt) and [SSN Query](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/SSN_Query.txt).

## 3: MySQL Login.

Verify by looking inside the php file [login.php](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/login.php).

## 4: MySQL Misc Queries.

Verify by looking inside the MySQL snippets [MISC Script](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/MISC_Script.txt) and the corresponding query.

#### Question A: [MISC_Query_A](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/MISC_Query_A.txt)
```SELECT fname FROM emp GROUP BY fname HAVING ( COUNT(fname) > 1 )```

#### Question B: [MISC_Query_B](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/MISC_Query_B.txt)
```SELECT * FROM emp WHERE id IN (SELECT id FROM emp_phone)```

#### Question C: [MISC_Query_C](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/MISC_Query_C.txt)
```SELECT emp.id, emp.fname, emp.lname, emp_phone.phone FROM emp LEFT JOIN emp_phone ON (emp.id = emp_phone.id)```

#### Question D: [MISC_Query_D](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/MISC_Query_D.txt)
```SELECT * FROM emp WHERE id NOT IN (SELECT id FROM emp_phone)```

## 5: Play a game of bowling.

Verify by looking inside the php file [bowling.php](https://github.com/mstraughan86/Code-Challenges/blob/master/DataX/bowling.php).

## 6: Decrypt a string.

Run ```php decrypt.php``` and confirm the output matches what should be the secret message! (It says ```Works on my box!```.)
