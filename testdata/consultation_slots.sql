--Consultation Slots
--Truncate Table
DELETE FROM consultation_slot;
--Re-initialize Table with test data
insert into consultation_slot values(1,NULL,60,"2024-02-01 09:00:00","2024-02-01 10:00:00",1,"available");
insert into consultation_slot values(2,NULL,60,"2024-02-01 09:00:00","2024-02-01 10:00:00",2,"available");
insert into consultation_slot values(3,NULL,60,"2024-02-02 09:00:00","2024-02-02 10:00:00",3,"available");
insert into consultation_slot values(4,NULL,60,"2024-02-02 13:00:00","2024-02-02 14:00:00",4,"available");
insert into consultation_slot values(5,NULL,90,"2024-02-08 09:00:00","2024-02-08 10:30:00",1,"available");
insert into consultation_slot values(6,NULL,60,"2024-02-08 09:00:00","2024-02-08 10:00:00",2,"available");
insert into consultation_slot values(7,NULL,60,"2024-02-09 09:00:00","2024-02-09 10:00:00",3,"available");
insert into consultation_slot values(8,NULL,120,"2024-02-09 13:00:00","2024-02-09 15:00:00",4,"available");
insert into consultation_slot values(9,NULL,60,"2024-02-15 09:00:00","2024-02-15 10:00:00",1,"available");
insert into consultation_slot values(10,NULL,60,"2024-02-15 09:00:00","2024-02-15 10:00:00",2,"available");
insert into consultation_slot values(11,NULL,90,"2024-02-16 09:00:00","2024-02-16 10:30:00",3,"available");
insert into consultation_slot values(12,NULL,90,"2024-02-16 13:00:00","2024-02-16 14:30:00",4,"available");
insert into consultation_slot values(13,NULL,60,"2024-02-22 09:00:00","2024-02-22 10:00:00",1,"available");
insert into consultation_slot values(14,NULL,60,"2024-02-22 09:00:00","2024-02-22 10:00:00",2,"available");
insert into consultation_slot values(15,NULL,60,"2024-02-23 09:00:00","2024-02-23 10:00:00",3,"available");
insert into consultation_slot values(16,NULL,60,"2024-02-23 13:00:00","2024-02-23 14:00:00",4,"available");
insert into consultation_slot values(17,NULL,60,"2024-02-29 09:00:00","2024-02-29 10:00:00",1,"available");
insert into consultation_slot values(18,NULL,120,"2024-02-29 09:00:00","2024-02-29 11:00:00",2,"available");
insert into consultation_slot values(19,NULL,60,"2024-03-01 09:00:00","2024-03-01 10:00:00",3,"available");
insert into consultation_slot values(20,NULL,90,"2024-03-01 13:00:00","2024-03-01 14:30:00",4,"available");

