using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class TowerScipt : MonoBehaviour
{
    private SpriteRenderer sr;
    private PlayerController player;

    private void Start()
    {
        sr = gameObject.GetComponent<SpriteRenderer>();
    }

    private void OnMouseOver()
    {
        sr.color = Color.green;
        if (player == null)
            return;
        if (Input.GetMouseButtonDown(0))
        {
            player.StartRotate();
        }
        if (Input.GetMouseButtonUp(0))
        {
            player.StopRotate();
        }
    }

    private void OnMouseExit()
    {
        sr.color = Color.white;
    }

    private void OnTriggerStay2D(Collider2D collision)
    {
        if (collision.gameObject.CompareTag("Player"))
        {
            player = collision.gameObject.GetComponent<PlayerController>();
        }
    }

    private void OnTriggerExit2D(Collider2D collision)
    {
        if (collision.gameObject.CompareTag("Player"))
        {
            player = null;
        }
    }
}
