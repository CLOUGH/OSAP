CREATE DATABASE osap;
GRANT select, insert, update, index, alter, create, drop
	ON  osap.*
	TO osap_system@'localhost' IDENTIFIED by 'pass123';