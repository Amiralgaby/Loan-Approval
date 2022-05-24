#!/bin/bash

dir="guzzle-client-suite-test/src"

for i in {1..13}
do
	php "$dir/loan-approval-suite-test.php" &
	php "$dir/check-account-suite-test.php" &
	php "$dir/account-manager-suite-test/client.php" &
done
