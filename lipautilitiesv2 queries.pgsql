SELECT *
FROM lipautilitiestest.transaction_logs 
ORDER BY created_at DESC
LIMIT 15;

SELECT *
FROM lipautilitiestest.event_logs
-- WHERE transaction_log_id = 22
ORDER BY created_at DESC
LIMIT 15;

SELECT *
FROM lipautilitiestest.utilities
ORDER BY created_at DESC
LIMIT 15;

SELECT *
FROM lipautilitiestest.utility_payment_methods 
ORDER BY created_at DESC
LIMIT 15;

SELECT *
FROM lipautilitiestest.user_utilities
ORDER BY created_at DESC
LIMIT 15;

SELECT *
FROM lipautilitiestest.utility_payments
ORDER BY created_at DESC
LIMIT 15;

SELECT * 
FROM lipautilitiestest.users;

SELECT *
FROM lipautilitiestest.roles; 

SELECT *
FROM lipautilitiestest.model_has_roles
WHERE model_id = 7;