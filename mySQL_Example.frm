SELECT * FROM salaries;
SELECT employees.first_name, employees.last_name, salaries.salary FROM employees, salaries WHERE salaries.to_date = '9999-01-01 00:00:00' and employees.'emp_no' = salaries.'emp_no';
