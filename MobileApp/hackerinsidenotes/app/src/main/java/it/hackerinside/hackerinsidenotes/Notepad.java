package it.hackerinside.hackerinsidenotes;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.Spinner;

import org.json.JSONArray;

import java.net.CookieHandler;
import java.util.ArrayList;

public class Notepad extends AppCompatActivity {
    public static User utenteLoggato = new User();
    
    Spinner spinnerTitoloNote = null;
    EditText txtbNotes;
    EditText txtbTitolo;

    ArrayList<Nota> note = new ArrayList<Nota>();
    @Override

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notepad);

        spinnerTitoloNote = (Spinner) findViewById(R.id.spinnerTitoloNote);
        txtbNotes = findViewById(R.id.txtbNotes);
        txtbTitolo = findViewById(R.id.txtbTitolo);




        CookieHandler.setDefault(utenteLoggato.cookieContainer); //Contenitore per i cookie (utilizzato per le sessioni)

        Intent intent = getIntent();

        try {
            utenteLoggato.UID = utenteLoggato.login(intent.getStringExtra("username"),intent.getStringExtra("password"));

        } catch (Exception e) {
            e.printStackTrace();
        }

        refreshNotes();

        spinnerTitoloNote.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) { //Verifica quando la selezione dello spinner è cambiata e imposta il testo della nota
                // your code here
                try {
                    txtbNotes.setText(utenteLoggato.getNote(((Nota) spinnerTitoloNote.getSelectedItem()).ID).nota);
                    txtbTitolo.setText(((Nota) spinnerTitoloNote.getSelectedItem()).titolo);
                } catch (Exception e) {
                    e.printStackTrace();
                }
            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // your code here
            }

        });

    }

    public void refreshNotes(){ //Funzione che prende le note dal server
        try {
            note.clear();

            JSONArray notes = new JSONArray(utenteLoggato.getNotes());

            for(int i=0;i<notes.length();i++){

                note.add(new Nota(
                                notes.getJSONObject(i).getString("ID"),
                                notes.getJSONObject(i).getString("titolo"),
                                notes.getJSONObject(i).getString("nota"),
                                notes.getJSONObject(i).getString("dataSalvataggio")
                        )

                );


            }

            ArrayAdapter<Nota> adapter = new ArrayAdapter<Nota>(this, R.layout.spinner_item,note);
            adapter.setDropDownViewResource(R.layout.spinner_item);

            spinnerTitoloNote.setAdapter(adapter);
        } catch (Exception e) {
            e.printStackTrace();
        }
    }


    public void btn_deleteNote(View v) throws Exception { //Bottone per eliminare una nota
        utenteLoggato.deleteNote(((Nota)spinnerTitoloNote.getSelectedItem()).ID);
        refreshNotes();

    }
    public void btn_addNote(View v) throws Exception { //Bottone per aggiungere una nota
        utenteLoggato.addNote(txtbTitolo.getText().toString(),txtbNotes.getText().toString());
        refreshNotes();

    }

    public void btn_saveNote(View v) throws Exception { //Bottone per modificare una nota
        utenteLoggato.saveNote(
                ((Nota)spinnerTitoloNote.getSelectedItem()).ID,
                txtbTitolo.getText().toString(),
                txtbNotes.getText().toString()
        );
        refreshNotes();

    }
}