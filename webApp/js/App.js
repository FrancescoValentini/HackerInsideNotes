import NotesView from "./NotesView.js";
import NotesAPI from "./NotesAPI.js";

export default class App {
    constructor(root) {
        this.notes = [];
        this.activeNote = null;
        this.view = new NotesView(root, this._handlers());

        this._refreshNotes();
    }

    _getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
      }
    _refreshNotes() {
        //NotesAPI.downloadNotes();
        /*const req = $.post("http://192.168.1.21/hackerinsidenotes/Backend/srv_getNotes.php",
        {
          uid: "3dpoANLgeksFvufR"
        },
        function(data,status){
           
            //localStorage.setItem("notesapp-notes", JSON.stringify(data));
            return data;
        });*/
        var ris;
        $.ajax({
            type: "POST",
            url: "http://" + document.URL.split("/")[2] + "/hackerinsidenotes/Backend/srv_getNotes.php",
            async: false,
            data: 
            {
                uid: this._getCookie("UID") //Prende il cookie con l'ID utente
            },
            success: function(response) { ris = response; }
         });

        const notes = ris;//NotesAPI.downloadNotes(); //JSON.parse(req.responseJSON);//NotesAPI.getAllNotes();
        this._setNotes(notes);

        if (notes.length > 0) {
            this._setActiveNote(notes[0]);
        }
    }

    _setNotes(notes) {
        this.notes = notes;
        this.view.updateNoteList(notes);
        this.view.updateNotePreviewVisibility(notes.length > 0);
    }

    _setActiveNote(note) {
        this.activeNote = note;
        this.view.updateActiveNote(note);
    }

    _handlers() {
        return {
            onNoteSelect: noteId => {
                const selectedNote = this.notes.find(note => note.ID == noteId);
                this._setActiveNote(selectedNote);
            },
            onNoteAdd: () => {
                const newNote = {
                    titolo: "Nuova nota",
                    nota: "...",
                };
                var ris;
                $.ajax({
                    type: "POST",
                    url: "http://" + document.URL.split("/")[2] +"/hackerinsidenotes/Backend/srv_addNote.php",
                    async: false,
                    data: 
                    {
                        uid: this._getCookie("UID"), //Prende il cookie con l'ID utente
                        titolo: newNote.titolo,
                        nota: newNote.nota
                    },
                    success: function(response) { ris = response; }
                 });
                //console.log(ris);
                this._refreshNotes();
            },
            onNoteEdit: (titolo, nota) => {

                var ris;
                $.ajax({
                    type: "POST",
                    url: "http://" + document.URL.split("/")[2] +"/hackerinsidenotes/Backend/srv_editNote.php",
                    async: false,
                    data: 
                    {
                        noteID: this.activeNote.ID, //Prende il cookie con l'ID utente
                        titolo: titolo,
                        nota: nota
                    },
                    success: function(response) { ris = response; }
                 });
                //console.log(ris);
                this._refreshNotes();
            },
            onNoteDelete: noteId => {

                var ris;
                $.ajax({
                    type: "POST",
                    url: "http://" + document.URL.split("/")[2] +"/hackerinsidenotes/Backend/srv_deleteNote.php",
                    async: false,
                    data: 
                    {
                        noteID: noteId, //Prende il cookie con l'ID utente
                    },
                    success: function(response) { ris = response; }
                 });
                //console.log(ris);
                this._refreshNotes();
            },
        };
    }
}
