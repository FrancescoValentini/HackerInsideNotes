package it.hackerinside.hackerinsidenotes;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.preference.PreferenceManager;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import org.json.JSONObject;

import java.net.CookieHandler;
import java.net.CookieManager;
import java.net.CookiePolicy;
import java.net.HttpCookie;
import java.net.URI;

public class MainActivity extends AppCompatActivity {
    EditText txtbUsername,txtbServer;
    EditText txtbPassword;
    Button btnLogin;
   public static User utenteLoggato;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        txtbPassword = (EditText) findViewById(R.id.txtbPassword);
        txtbUsername = findViewById(R.id.txtbUsername);
        txtbServer = findViewById(R.id.txtbServerURL);
        btnLogin = findViewById(R.id.btnLogin);
        utenteLoggato = new User();

        CookieHandler.setDefault(utenteLoggato.cookieContainer);

        SharedPreferences prefs = PreferenceManager.getDefaultSharedPreferences(this);
        String server = prefs.getString("server", "");
        String username = prefs.getString("username", "");
        if(!server.equalsIgnoreCase("") && !username.equalsIgnoreCase("")){
            txtbServer.setText(server);
            txtbUsername.setText(username);
        }



    }

    public void btnloginClick(View v){
        utenteLoggato.server = txtbServer.getText().toString();
        try{
            utenteLoggato.UID = utenteLoggato.login(txtbUsername.getText().toString(),txtbPassword.getText().toString());

            if(utenteLoggato.UID != "-1"){
                Log.d("uid",utenteLoggato.UID);
               Intent intent = new Intent(MainActivity.this, it.hackerinside.hackerinsidenotes.Notepad.class);


                intent.putExtra("username",txtbUsername.getText().toString());
                intent.putExtra("password",txtbPassword.getText().toString());
                intent.putExtra("server",txtbServer.getText().toString());
                SharedPreferences preferences = PreferenceManager.getDefaultSharedPreferences(this);
                SharedPreferences.Editor editor = preferences.edit();
                editor.putString("server",txtbServer.getText().toString());
                editor.putString("username",txtbUsername.getText().toString());
                editor.apply();

               startActivity(intent);
           }
        }catch(Exception e){

        }
    }
}