package it.hackerinside.hackerinsidenotes;

import androidx.appcompat.app.AppCompatActivity;

import android.os.Bundle;
import android.util.Log;
import android.widget.EditText;

import java.net.CookieHandler;

public class MainActivity extends AppCompatActivity {
    EditText txtbUsername,txtbServer;
    EditText txtbPassword;
   public static User utenteLoggato;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        txtbPassword = findViewById(R.id.txtbPassword);
        txtbUsername = findViewById(R.id.txtbUsername);
        txtbServer = findViewById(R.id.txtbServerURL);
        utenteLoggato = new User();
        CookieHandler.setDefault(utenteLoggato.cookieContainer);

    }

    public void btnLogin_click(android.view.View v) throws Exception {
        utenteLoggato.UID = utenteLoggato.login("admin","admin");
        Log.d("login",utenteLoggato.UID);
        Log.d("getN",utenteLoggato.getNotes());
    }
}