# Portfolio23

An dieser Stelle wird der Code zum Portfolio23 Schritt für Schritt erklärt. Wir schauen uns als erstes die Datei *test1.php* an.  

### 1. test1.php

![img.png](img.png)

Hieraus kann man folgendes ableiten:  

* In Zeile 12 wird mit dem new-Operator ein Objekt *$student* der Klasse ***Student*** erzeugt. Dieses enthält die Attribute ___firstname,  
lastname,matrnr, email und pw___, es muss also eine entsprechende Klasse ***Student*** mit genau diesen Attributen angelegt werden.
* In Zeile 14 sehen wir, dass auf dem Objekt *$student* die Methode ***pw_isValid()*** aufgerufen wird. Wir müssen später in der Klasse  
* ***Student*** also eine solche Methode implementieren.  
* In Zeile 7 wird mit dem new-Operator ein Objekt *$db* der Klasse ***Database*** erzeugt. Wir müssen also auch eine Klasse ***Database*** anlegen.  
* Laut Video test1 soll diese Klasse eine Datenbankverbindung erzeugen. Weiterhin sehen wir in Zeile 15, dass die Klasse ***Database*** eine Methode  
* ***writeStudentToDB*** enthält, die ein Objekt der Klasse ***Student*** als Parameter übergeben bekommt. Wir müssen diese Methode also später in  
* der Klasse ***Database*** implementieren.  
* Es stellt sich nun die Frage, wo wir die beiden Klassen ***Student*** und ***Database*** samt ihrer Attribute und Methoden implementieren sollen.  
Die aktuelle Datei test1.php dürfen laut Aufgabenvideo nicht anfassen. Wir sehen allerdings in Zeile 4, dass eine Datei namens *objects.php*  
importiert wird. Offensichtlich muss also eine solche Datei angelegt und hierin die Implementierung aller benötigten Klassen, Attribute und Methoden  
durchgeführt werden.  

Bevor wir loslegens, schauen wir uns als nächstes aber erst noch die Datei test2.php an.  

### 2. test2.php  

![img_1.png](img_1.png)

Die Datei erinnert sehr stark an test1.php.

Hieraus kann man folgendes ableiten:

* In Zeile 9 wird mit dem new-Operator ein Objekt *$lecturer* der Klasse ***Lecturer*** erzeugt. Dieses enthält die Attribute ___firstname,  
  lastname und pw___, es muss also eine entsprechende Klasse ***Lecturer*** mit genau diesen Attributen angelegt werden.
* In Zeile 14 sehen wir, dass auch auf dem Objekt *$lecturer* die Methode ***pw_isValid()*** aufgerufen wird. 
* In Zeile 7 wird mit dem new-Operator ein Objekt *$db* der Klasse ***Database*** erzeugt. Weiterhin sehen wir in Zeile 15, dass die Klasse  
***Database*** eine Methode ***writeLecturerToDB*** enthält, die ein Objekt der Klasse ***Lecturer*** als Parameter übergeben bekommt. Wir müssen diese Methode  
also später in der Klasse ***Database*** implementieren.  

___Zwischenfazit___  
Es ist also zunächst folgendes zu tun:
- Anlegen einer Datei *objects.php* und hierin:  
- Anlegen einer Klasse *Lecturer* 
  - mit den Attributen ___firstname,lastname und pw___  
  - mit der Methode ***pw_isValid()***  
- Anlegen einer Klasse *Student*  
  - mit den Attributen ___firstname,lastname,matrnr, email und pw___  
  - mit der Methode ***pw_isValid()***  
- Anlegen einer Klasse *Database* mit den Methoden
  - ***writeStudentToDB***  
  - ***writeLecturerToDB***  

**Wichtig**:  
Wenn wir die Klassen Lecturer und Student vergleichen, sehen wir:  
- Die 3 Attribute *firstname,lastname,pw* der Klasse Lecturer sind auch alle in der Klasse *Student* enthalten.  
- Die Methode *pw_isValid()* kommt in beiden Klassen vor und soll laut Aufgabenstellung auch dasselbe leisten.
- Um Wiederholungen zu vermeiden (und damit im Sinne einer besseren Wartbarkeit und Übersichtlichkeit des Codes)  
können wir also Vererbung einsetzen: Die Klasse *Student* erbt von der Klasse *Lecturer*, so dass wir die drei identischen  
Attribute (s.o.) und die Methode pw_isValid() nur einmal in der Klasse *Lecturer* implementieren müssen.  

### 3. Implementierung der beiden Klassen Lecturer und Student

Wir legen zunächst die Datei *objects.php* an. Hierin wird der gesamte Code aller 5 Aufgaben zu implementieren sein.  

**3.1** Klasse *Lecturer*  

![img_3.png](img_3.png)

In Zeile 5 werden die Attribute definiert und mit dem Wert null initialisiert.  
In den Zeilen 7-12 ist der Konstruktor enthalten. Ein Konstruktor ist eine Funktion zur  
Erzeugung eines Objekts der dazugehörigen Klasse.  

