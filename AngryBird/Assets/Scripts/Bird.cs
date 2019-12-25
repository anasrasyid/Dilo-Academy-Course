using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Events;

public class Bird : MonoBehaviour
{
    public enum BirdState { Idle, Thrown, HitSomething }
    public GameObject Parent;
    public Rigidbody2D rigidbody2D;
    public CircleCollider2D circleCollider;

    private BirdState _state;
    private float _minVelocity = 0.05f;
    public bool _flagDestroy = false;

    public UnityAction onBirdDestroyed = delegate { };
    public UnityAction<Bird> onBirdShoot = delegate { };
    public BirdState State { get { return _state; } }

    void Start()
    {
        rigidbody2D.bodyType = RigidbodyType2D.Kinematic;
        circleCollider.enabled = false;
        _state = BirdState.Idle;
    }

    private void FixedUpdate()
    {
        if (_state == BirdState.Idle && rigidbody2D.velocity.sqrMagnitude >= _minVelocity)
        {
            _state = BirdState.Thrown;
        }

        if ((_state == BirdState.Thrown || _state == BirdState.HitSomething)
            && rigidbody2D.velocity.sqrMagnitude < _minVelocity && ! _flagDestroy)
        {
            _flagDestroy = true;
            StartCoroutine(DestroyAfter(2));
        }
    }

    private IEnumerator DestroyAfter(float second)
    {
        yield return new WaitForSeconds(second);
        Destroy(gameObject);
    }

    public void MoveTo(Vector2 target, GameObject parent)
    {
        gameObject.transform.SetParent(parent.transform);
        gameObject.transform.position = target;
    }

    public void Shoot(Vector2 velocity, float distance, float speed)
    {
        circleCollider.enabled = true;
        rigidbody2D.bodyType = RigidbodyType2D.Dynamic;
        rigidbody2D.velocity = velocity * speed * distance;
        onBirdShoot(this);
    }

    private void OnDestroy()
    {
        if(_state == BirdState.Thrown || _state == BirdState.HitSomething)
            onBirdDestroyed();
    }

    private void OnCollisionEnter2D(Collision2D collision)
    {
        _state = BirdState.HitSomething;
    }

    public virtual void OnTap()
    {

    }
}
