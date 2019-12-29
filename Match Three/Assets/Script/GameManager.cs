using UnityEngine.UI;
using UnityEngine;

public class GameManager : MonoBehaviour
{
    //Instance sebagai global access
    public static GameManager instance;
    int playerScore;
    public Text scoreText, finalScoreText;
    public Text timeText;

    public float timePlay = 10f;
    public GameObject panelEnd;

    // singleton
    void Start()
    {
        if (instance == null)
        {
            instance = this;
        }
        else if (instance != null)
        {
            Destroy(gameObject);
        }

        DontDestroyOnLoad(gameObject);
    }

    //Update score dan ui
    public void GetScore(int point)
    {
        playerScore += point;
        scoreText.text = playerScore.ToString();
    }

    public void TimePlay()
    {
        int second = Mathf.RoundToInt(timePlay);
        int minute = second / 60;
        second = second % 60;
        timeText.text = string.Format("{0:00} : {1:00}", minute, second); ;
    }

    public void CheckedEndGame()
    {
        if (timePlay < 0)
        {
            Time.timeScale = 0;
            finalScoreText.text = scoreText.text;
            panelEnd.SetActive(true);
        }
    }
}