using System.Collections;
using System.Collections.Generic;
using UnityEngine;

public class InputHandler : MonoBehaviour
{
    public PlayerMovement playerMovement;
    public PlayerShooting playerShooting;
    public PlayerShooting playerShootingSpecial;
    public GameOverManager gameOverManager;
    float timeSpecial = 0;

    Stack<Command> commands = new Stack<Command>();
    
    void FixedUpdate()
    {
        if (gameOverManager.isGameOver)
            return;
        Command moveCommand = InputMovementHandling();
        if(moveCommand != null)
        {
            commands.Push(moveCommand);
            moveCommand.Excute();
        }
    }

    void Update()
    {
        if (gameOverManager.isGameOver)
            return;
        timeSpecial += Time.deltaTime;
        Command shootCommand = InputShootHandling();
        if(shootCommand != null)
        {
            shootCommand.Excute();
        }
    }

    Command InputMovementHandling()
    {
        if (Input.GetKey(KeyCode.D))
        {
            return new MoveCommand(playerMovement, 1, 0);
        }
        else if (Input.GetKey(KeyCode.A))
        {
            return new MoveCommand(playerMovement, -1, 0);
        }
        else if (Input.GetKey(KeyCode.W))
        {
            return new MoveCommand(playerMovement, 0, 1);
        }
        else if (Input.GetKey(KeyCode.S))
        {
            return new MoveCommand(playerMovement, 0, -1);
        }
        else if (Input.GetKey(KeyCode.Z))
        {
            return Undo();
        }
        else
        {
            return new MoveCommand(playerMovement, 0, 0); ;
        }
    }

    Command Undo()
    {
        if (commands.Count > 0)
        {
            Command undoCommand = commands.Pop();
            undoCommand.UnExecute();
        }
        return null;
    }

    Command InputShootHandling()
    {
        if (Input.GetButtonDown("Fire1"))
        {
            return new ShootCommand(playerShooting);
        }else if (Input.GetButtonDown("Fire2") && timeSpecial >= 2.0f)
        {
            timeSpecial = 0;
            return new ShootCommand(playerShootingSpecial);
        }
        return null;
    }
}
