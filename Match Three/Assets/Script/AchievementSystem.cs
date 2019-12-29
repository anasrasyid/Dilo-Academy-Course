using System.Collections;
using UnityEngine.UI;
using UnityEngine;

public class AchievementSystem : Observer
{

    public Image achievementBanner;
    public Text achievementText;

    //Event
    TileEvent cookiesEvent, cakeEvent, gumEvent, timeEvent;

    void Start()
    {
        PlayerPrefs.DeleteAll();

        //Buat event
        cookiesEvent = new CookiesTileEvent(3);
        cakeEvent = new CakeTileEvent(10);
        gumEvent = new GumTileEvent(5);
        timeEvent = new TimeTileEvent();

        StartCoroutine(registerDelay());
    }

    IEnumerator registerDelay()
    {
        yield return new WaitForSeconds(1f);
        foreach (var poi in FindObjectsOfType<PointOfInterest>())
        {
            poi.RegisterObserver(this);
        }
    }

    public override void OnNotify(string value)
    {
        string key;
        //Seleksi event yang terjadi, dan panggil class event nya
        if (value.Equals("Cookies event"))
        {
            cookiesEvent.OnMatch();
            if (cookiesEvent.AchievementCompleted())
            {
                key = "Match first cookies";
                NotifyAchievement(key, value);
                GameManager.instance.timePlay += 10;
            }
        }

        if (value.Equals("Cake event"))
        {
            cakeEvent.OnMatch();
            if (cakeEvent.AchievementCompleted())
            {
                key = "Match 10 cake";
                NotifyAchievement(key, value);
                GameManager.instance.timePlay += 10;
            }
        }

        if (value.Equals("Gum event"))
        {

            gumEvent.OnMatch();
            if (gumEvent.AchievementCompleted())
            {
                key = "Match 5 gum";
                NotifyAchievement(key, value);
                GameManager.instance.timePlay += 10;
            }
        }

        if (value.Equals("Time event"))
        {

            timeEvent.OnMatch();
            if (timeEvent.AchievementCompleted())
            {
                key = "Adding Time Play 3 S";
                NotifyAchievement(key, value);
                GameManager.instance.timePlay += 3;
                timeEvent = new TimeTileEvent();
            }
        }
    }

    void NotifyAchievement(string key, string value)
    {
        //check jika achievement sudah diperoleh
        if (PlayerPrefs.GetInt(value) == 1)
            return;

        PlayerPrefs.SetInt(value, 1);
        achievementText.text = key + " Unlocked !";

        //pop up notifikasi
        StartCoroutine(ShowAchievementBanner());
    }

    void ActivateAchievementBanner(bool active)
    {
        achievementBanner.gameObject.SetActive(active);
    }

    IEnumerator ShowAchievementBanner()
    {
        ActivateAchievementBanner(true);
        yield return new WaitForSeconds(2f);
        ActivateAchievementBanner(false);
    }

    private class CakeTileEvent : TileEvent
    {
        private int v;
        int count = 0;

        public CakeTileEvent(int v)
        {
            this.v = v;
        }

        public override bool AchievementCompleted()
        {
            return v == count;
        }

        public override void OnMatch()
        {
            count++;
        }
    }

    private class GumTileEvent : TileEvent
    {
        private int v;
        int count = 0;

        public GumTileEvent(int v)
        {
            this.v = v;
        }

        public override bool AchievementCompleted()
        {
            return count == v;
        }

        public override void OnMatch()
        {
            count++;
        }
    }
}

internal class TimeTileEvent : TileEvent
{
    private int v = 3;

    public override bool AchievementCompleted()
    {
        return v == 0;
    }

    public override void OnMatch()
    {
        v--;
    }
}