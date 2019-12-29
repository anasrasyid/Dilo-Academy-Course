internal class CookiesTileEvent : TileEvent
{
    private int v = 0;
    int count = 0;

    public CookiesTileEvent(int v)
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