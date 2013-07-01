#!/bin/sh

#curl http://crm_32/sites/crm_32/modules/civicrm/extern/ipn.php?reset=1\&module=event\&contactID=102\&participantID=2222\&contributionID=4927\&eventID=57 -d mc_gross=289.00 -d txn_id=5M6789701L0500744 -d invoice=464c1b17c130a3eaffc159629013203e -d payment_status=Completed -d mc_fee=29.00


curl http://192.168.2.56/v43/sites/all/modules/civicrm/extern/ipn.php -d rp_invoice_id='m=contribute&i=99b53352684a7d068e6657325c6e2e10&c=202&r=8&b=108&p=1' -d mc_gross=10.00 -d txn_id= -d payment_status=Completed -d payment_fee=1.00 -d txn_type="recurring_payment" -d recurring_payment_id=3dc7c710dd3d