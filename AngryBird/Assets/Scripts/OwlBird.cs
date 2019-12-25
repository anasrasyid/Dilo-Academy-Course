using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class OwlBird : Bird
{
    [SerializeField]
    private float _changePower = 100f;
    private bool _isChange = false;

    private void ChangeDirection()
    {
        if(State == BirdState.Thrown || !_isChange)
        {
            _isChange = false;
            rigidbody2D.velocity = Vector2.down * _changePower;
        }
    }

    public override void OnTap()
    {
        ChangeDirection();
    }
}
