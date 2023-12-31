-- dbcreationfile

CREATE TABLE "student" (
	"id"	INTEGER NOT NULL,
	"first_name"	TEXT NOT NULL,
	"last_name"	TEXT NOT NULL,
	"mtr"	TEXT NOT NULL,
	"email"	TEXT NOT NULL,
	"pw"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);

CREATE TABLE "lecturer" (
	"id"	INTEGER NOT NULL,
	"first_name"	TEXT NOT NULL,
	"last_name"	TEXT NOT NULL,
	"pw"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);

CREATE TABLE "consultation_slot" (
	"id"	INTEGER NOT NULL,
	"booker"	INTEGER,
	"duration"	NUMERIC NOT NULL,
	"start_time"	datetime NOT NULL,
	"end_time"	datetime NOT NULL,
	"lecturer"	INTEGER NOT NULL,
	"status"	TEXT NOT NULL,
	PRIMARY KEY("id" AUTOINCREMENT)
);