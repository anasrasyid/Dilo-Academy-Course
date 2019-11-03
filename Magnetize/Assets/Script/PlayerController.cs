using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class PlayerController : MonoBehaviour
{
    private Rigidbody2D rigidbody2D;
    public float moveSpeed;
    public float pullForce = 100f;
    public float rotateSpeed = 360f;
    
    private GameObject clostestTower;
    private GameObject hookedTower;
    private bool isPulled = false;

    private UIController uIController;
    private AudioSource audio;
    private bool isCrashed = false;
    private Vector3 startPosition;

    void Start()
    {
        rigidbody2D = GetComponent<Rigidbody2D>();
        uIController = GameObject.Find("Canvas").GetComponent<UIController>();
        audio = GetComponent<AudioSource>();
        startPosition = transform.position;
    }
    
    void Update()
    {
        if (isCrashed)
        {
            if (!audio.isPlaying)
            {
                restartPosition();
                return;
            }
        }
        rigidbody2D.velocity = -transform.up * moveSpeed;
    }

    public void StartRotate()
    {
        if (!isPulled)
        {
            hookedTower = clostestTower;
            if (hookedTower)
            {
                float distance = Vector2.Distance(transform.position, hookedTower.transform.position);

                Vector3 pullDirection = (hookedTower.transform.position - transform.position).normalized;
                float newPullForce = Mathf.Clamp(pullForce / distance, 30, 100);
                rigidbody2D.AddForce(pullDirection * newPullForce);

                rigidbody2D.angularVelocity = -rotateSpeed / distance;
                isPulled = true;
            }
        }
    }

    public void StopRotate()
    {
        isPulled = false;
        rigidbody2D.angularVelocity = 0;
    }

    private void restartPosition()
    {
        transform.position = startPosition;

        transform.rotation = Quaternion.Euler(0f, 0f, 90f);

        rigidbody2D.angularVelocity = 0;

        isCrashed = false;

        if (clostestTower)
        {
            clostestTower.GetComponent<SpriteRenderer>().color = Color.white;
            clostestTower = null;
        }
    }

    private void OnCollisionEnter2D(Collision2D collision)
    {
        if (collision.gameObject.CompareTag("Wall"))
            if (!isCrashed)
            {
                audio.Play();
                rigidbody2D.velocity = Vector3.zero;
                rigidbody2D.angularVelocity = 0;
                isCrashed = true;
            }
    }

    private void OnTriggerEnter2D(Collider2D collision)
    {
        if (collision.gameObject.CompareTag("Goal"))
            uIController.endGame();
    }
    private void OnTriggerStay2D(Collider2D collision)
    {
        if (collision.gameObject.CompareTag("Tower"))
        {
            clostestTower = collision.gameObject;
           // collision.gameObject.GetComponent<SpriteRenderer>().color = Color.green;
        }
    }
    private void OnTriggerExit2D(Collider2D collision)
    {
        if (isPulled) return;
        if (collision.gameObject.CompareTag("Tower"))
        {
            clostestTower = null;
            //collision.gameObject.GetComponent<SpriteRenderer>().color = Color.white;
        }
    }
}
