package it.hackerinside.hackerinsidenotes;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;

import java.net.CookieHandler;

public class Notepad extends AppCompatActivity {
    public static User utenteLoggato;
    @Override

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_notepad);

        //Riprende l'oggetto UtenteLoggato
        Intent intent = getIntent();
        utenteLoggato = (User) intent.getSerializableExtra("UTENTELOGGATO");

        CookieHandler.setDefault(utenteLoggato.cookieContainer);
    }
}