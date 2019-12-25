using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class GameController : MonoBehaviour
{
    public SlingShooter slingShooter;
    public TrailController trailController;
    public List<Bird> birds;
    public List<Enemy> enemies;
    public BoxCollider2D tapCollider;

    private bool _isGameEnded = false;
    private Bird _shotBird;

    void Start()
    {
        for (int i = 0; i < birds.Count; i++)
        {
            birds[i].onBirdDestroyed += ChangeBird;
            birds[i].onBirdShoot += AssignTrail;
        }
        for (int i = 0; i < enemies.Count; i++)
            enemies[i].onEnemyDestroyed += CheckGameEnd;

        slingShooter.InitiateBird(birds[0]);
        _shotBird = birds[0];
        tapCollider.enabled = false;
    }

    public void ChangeBird()
    {
        tapCollider.enabled = false;
        if (_isGameEnded)
            return;
        birds.RemoveAt(0);
        if (birds.Count > 0)
        {
            slingShooter.InitiateBird(birds[0]);
            _shotBird = birds[0];
        }
    }

    public void CheckGameEnd(GameObject destroyedEnemy)
    {
        for(int i = 0; i < enemies.Count; i++)
            if(enemies[i].gameObject == destroyedEnemy)
            {
                enemies.RemoveAt(i);
                break;
            }

        if (enemies.Count == 0)
            _isGameEnded = true;
    }

    public void AssignTrail(Bird bird)
    {
        trailController.SetBird(bird);
        StartCoroutine(trailController.SpawnTrail());
        tapCollider.enabled = true;
    }

    private void OnMouseUp()
    {
        if(_shotBird != null)
        {
            _shotBird.OnTap();
        }
    }
}
