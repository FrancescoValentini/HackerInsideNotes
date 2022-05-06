export default class NotesAPI {

    static downloadNotes() {
        $.post("http://192.168.1.21/hackerinsidenotes/Backend/srv_getNotes.php",
        {
          uid: "3dpoANLgeksFvufR"
        },
        function(data,status){
           
            //localStorage.setItem("notesapp-notes", JSON.stringify(data));
            return data;
        });
    }

    static getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
      }

    static getAllNotes() {
       // const notes = JSON.parse(localStorage.getItem("notesapp-notes") || "[]");
        //console.log(notes);
        /*return notes.sort((a, b) => {
            return new Date(a.updated) > new Date(b.updated) ? -1 : 1;
        });*/

        var ris;
        $.ajax({
            type: "POST",
            url: "http://192.168.1.21/hackerinsidenotes/Backend/srv_getNotes.php",
            async: false,
            data: 
            {
                uid: this._getCookie("UID") //Prende il cookie con l'ID utente
            },
            success: function(response) { ris = response; }
         });

       return ris;

    }

    static saveNote(noteToSave) {
        const notes = NotesAPI.getAllNotes();
        const existing = notes.find(note => note.ID == noteToSave.ID);

        // Edit/Update
        if (existing) {
            existing.titolo = noteToSave.titolo;
            existing.nota = noteToSave.nota;
            existing.dataSalvataggio = new Date().toISOString();
        } else {
            noteToSave.ID = Math.floor(Math.random() * 1000000);
            noteToSave.dataSalvataggio = new Date().toISOString();
            notes.push(noteToSave);
            
        }
        $.ajax({
            type: "POST",
            url: "http://192.168.130.122/hackerinsidenotes/Backend/srv_addNote.php",
            async: false,
            data: 
            {
                uid: this.getCookie("UID"), //Prende il cookie con l'ID utente
                titolo: notes.titolo,
                nota: notes.nota
            },
            success: function(response) { ris = response; }
         });
        localStorage.setItem("notesapp-notes", JSON.stringify(notes));
    }

    static deleteNote(id) {
        const notes = NotesAPI.getAllNotes();
        const newNotes = notes.filter(note => note.ID != id);

        localStorage.setItem("notesapp-notes", JSON.stringify(newNotes));
    }
}
